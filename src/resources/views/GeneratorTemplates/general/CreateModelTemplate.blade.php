<?php

use Rekamy\Generator\Console\RuleParser;

?>
<?="<?php

namespace " . $context->namespace['model'] . ";

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class " . ucfirst(Str::camel(Str::singular($tablename))) . " extends Model
{" ?>
    <?php if ($context->options['softDelete']) { ?>
    <?php foreach ($db->columns as $i => $column) {
    if ($column->TABLE_NAME == $tablename) {
    if (strpos($column->COLUMN_NAME, 'deleted_at') !== false) { ?>
    <?= "
    use SoftDeletes;
    " ?>
    <?php } 
    }
    } ?>
    <?php } ?>
    <?= "
    public \$table = '" . $tablename . "';

    public \$fillable = [
" ?><?php


    foreach ($db->columns as $i => $column) {
        if ($column->TABLE_NAME == $tablename) {
            echo "\n\t\t'" . $column->COLUMN_NAME . "',";
        }
    } ?>
<?= "
    ];

    public \$casts = [
" ?>
        <?php
        foreach ($db->columns as $column) {
            $rule = RuleParser::parsingCasts($db, $column);
            if ($column->TABLE_NAME == $tablename) {
                echo "'" . $column->COLUMN_NAME . "' => '" . $rule . "',\n\t\t";
            }
        } ?>
<?= "
    ];

    public static \$rules = [
" ?><?php
    foreach ($db->nullable as $nullable) {
        if ($nullable->TABLE_NAME == $tablename && $nullable->COLUMN_NAME != "id") {
            echo "\t\t'" . $nullable->COLUMN_NAME . "' => 'required',\n";
        } else {
            echo "\t\t//";
            break;
        }
    } ?>
<?= "
    ];

    public function author()
    {
        return \$this->belongsTo(User::class);
    }

    " ?><?php
        foreach ($db->constraints as $constraint) {
            if ($constraint->CONSTRAINT_NAME == 'PRIMARY') {
                continue;
            }
            if ($constraint->TABLE_NAME == $tablename) {
                echo "public function " . Str::camel(Str::singular($constraint->REFERENCED_TABLE_NAME)) . "() \n\t{";
                if ($constraint->REFERENCED_COLUMN_NAME == 'id') {
                    echo "\n\t\treturn \$this->belongsTo(" . ucfirst(Str::camel(Str::singular($constraint->REFERENCED_TABLE_NAME))) . "::class);\n";
                }
                echo "\t}\n\n\t";
            }
            if ($constraint->REFERENCED_TABLE_NAME == $tablename) {
                echo "public function " . Str::camel(Str::singular($constraint->TABLE_NAME)) . "() \n\t{";
                if ($constraint->REFERENCED_COLUMN_NAME == 'id') {
                    echo "\n\t\treturn \$this->hasMany(" . ucfirst(Str::camel(Str::singular($constraint->TABLE_NAME))) . "::class, '" . $constraint->COLUMN_NAME . "');\n";
                } else {
                    echo "\treturn \$this->hasOne(" . ucfirst(Str::camel(Str::singular($tablename))) . "::class, '" . $constraint->COLUMN_NAME . "');\n";
                }
                echo "\t}";
            } ?>
<?php } ?>
<?= "
}
"

?>