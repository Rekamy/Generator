<?php use Rekamy\Generator\Core\RuleParser; ?>

@php
@endphp

<?php
echo "
<?php
namespace $namespace;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Support\Str;\n" ?>
<?php if($hasRepoTrait): ?>
<?= "use App\RepoTraits\{$RepoTrait};" ?>
<?php endif; ?>
<?= "use Kirschbaum\PowerJoins\PowerJoins;

class $className extends Model
{"  
?>

<?php if($hasRepoTrait): ?>
<?= "\tuse HasFactory, PowerJoins, {$RepoTrait};\n" ?>
<?php else: ?>
<?= "\tuse HasFactory, PowerJoins;\n" ?>
<?php endif; ?>
<?php 
    if ($softDelete) :
        echo "\tuse SoftDeletes;\n";
    endif;
    ?>

<?php 
    if ($isUuid) :
        echo "\tpublic \$incrementing = false;\n";
    endif;
?>

<?= "\tpublic \$table = '$table';\n"?>

<?= "\tpublic \$fillable = [\n"?>
<?php 
    foreach ($columns as $i=> $column) :
        echo "\t\t'{$column->getName()}',\n";
    endforeach;
    echo "\t];\n";
?>

<?= "\tpublic \$casts = [\n" ?>
<?php 
    if($isUuid) :
        echo "\t\t'id' => 'string',\n";
    endif;
    foreach ($columns as $i=> $column) :
        echo "\t\t'{$column->getName()}' => '" . RuleParser::parseCast($column->getType()->getName()) . "',\n";
    endforeach;
    echo "\t];\n";
?>

<?= "\tpublic static \$rules = [\n" ?>
<?php
    foreach ($notNullColumns as $column) :
        echo "\t\t'{$column->getName()}' => 'required',\n";
    endforeach; 
    echo "\t];\n";
?>
<?= 
"
    protected static function boot()
    {
        parent::boot();\n" ?>
<?php 
    if($isUuid) : 
    echo "static::creating(function (\$post) {
            \$post->{\$post->getKeyName()} = (string) Str::uuid();
        });";
    endif;
?>
<?= "
    }

" 
?>
<?php
if($relations) {
    collect($relations)->each(function ($relation) { echo $relation . "\n"; });
}
/*
foreach ($db->get('constraints') as $constraint) {
    if ($constraint->CONSTRAINT_NAME == 'PRIMARY') {
        continue;
    }
    if ($constraint->TABLE_NAME == $table) {
        echo "public function " . Str::camel(Str::singular($constraint->REFERENCED_TABLE_NAME)) . "() \n\t{";
        if ($constraint->REFERENCED_COLUMN_NAME == 'id') {
            echo "\n\t\treturn \$this->belongsTo(" . ucfirst(Str::camel(Str::singular($constraint->REFERENCED_TABLE_NAME))) . "::class);\n";
        }
        echo "\t}\n\n\t";
    }
    if ($constraint->REFERENCED_TABLE_NAME == $table) {
        echo "public function " . Str::camel(Str::singular($constraint->TABLE_NAME)) . "() \n\t{";
        if ($constraint->REFERENCED_COLUMN_NAME == 'id') {
            echo "\n\t\treturn \$this->hasMany(" . ucfirst(Str::camel(Str::singular($constraint->TABLE_NAME))) . "::class, '" . $constraint->COLUMN_NAME . "');\n";
        } else {
            echo "\treturn \$this->hasOne(" . ucfirst(Str::camel(Str::singular($table))) . "::class, '" . $constraint->COLUMN_NAME . "');\n";
        }
        echo "\t}";
    } 
} 
*/
?>
{{ "}" }}
