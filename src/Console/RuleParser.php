<?php

namespace Rekamy\Generator\Console;

class RuleParser
{

    protected $db;
    protected $table;

    public function __contruct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public static function parse($db, $table): string
    {
        $rule = '';
        if ($table->IS_NULLABLE == "NO" && $table->EXTRA != 'auto_increment') {
            $rule .= 'required';
        }
        if (strpos($table->COLUMN_TYPE, 'varchar') !== false) {
            if (strpos($table->COLUMN_NAME, 'email') !== false) {
                $rule .= '|email';
            } else if (
                strpos($table->COLUMN_NAME, 'image') !== false
                && strpos($table->COLUMN_NAME, 'path') === false
            ) {
                $rule .= '|image';
            } else {
                $rule .= '|string:' . $table->CHARACTER_MAXIMUM_LENGTH;
            }
        }
        if (strpos($table->COLUMN_TYPE, 'number') !== false) {
            $rule .= '|numeric';
        }
        if (strpos($table->COLUMN_NAME, '_at') !== false) {
            $rule .= '|date';
        }
        if (strpos($table->COLUMN_TYPE, 'int') !== false) {
            $rule .= '|integer';
        }
        if ($table->COLUMN_NAME == "is_active") {
            $rule .= '|bool';
        }
        return $rule;
    }

    public static function parsingCasts($db, $column)
    {
        $rule = '';

        if (strpos($column->COLUMN_TYPE, 'varchar') !== false) {
            $rule .= 'string';
        }
        if (strpos($column->COLUMN_TYPE, 'int') !== false) {
            $rule .= 'integer';
        }
        if (strpos($column->COLUMN_TYPE, 'timestamp') !== false) {
            $rule .= 'datetime';
        }

        return $rule;
    }

    public static function ruleLibrary($type)
    {
        return  [
            'image',
            'email',
            'string',
            'mimes:jpeg,bmp,png',
            'date',
            'integer',
            'numeric',
            'required',
            'unique:table,column,except,idColumn',
            'boolean',
            'alpha',
            'alpha_num',
            'max:value',
        ];
    }
}
