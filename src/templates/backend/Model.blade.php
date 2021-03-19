<?php use Rekamy\Generator\Console\RuleParser; ?>

@php
@endphp

<?php
echo "
<?php
namespace $namespace;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class $className extends Model
{"  
?>

<?= "\tuse HasFactory;\n" ?>
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
        echo "\t\t'{$column->getName()}' => '" . RuleParser::parseType($column->getType()->getName()) . "',\n";
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
        parent::boot();

        static::creating(function (\$post) {
            \$post->{\$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function author()
    {
        return \$this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return \$this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return \$this->belongsTo(User::class, 'deleted_by');
    }

" 
?>
<?php
if($relations->get($table)) {
    foreach ($relations->get($table) as $relation) {
        echo $relation;
    }
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