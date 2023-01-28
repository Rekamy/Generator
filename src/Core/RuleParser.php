<?php

namespace Rekamy\Generator\Core;

use Str;

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

    public static function parseType($type)
    {
        switch (true) {
            case Str::contains($type, ['bigint', 'varchar', 'text']):
                $rule = 'string';
                break;
            case Str::contains($type, ['int', 'smallint']):
                $rule = 'integer';
                break;
            case Str::contains($type, ['timestamp', 'datetime']):
                $rule = 'date:Y-m-d H:i';
                break;

            default:
                $rule = $type;
                break;
        }

        return $rule;
    }

    public static function parseSwaggerType($type)
    {
        switch (true) {
            case Str::contains($type, ['bigint', 'varchar', 'text']):
                $rule = 'string';
                break;
            case Str::contains($type, ['int', 'smallint']):
                $rule = 'int64';
                break;
            case Str::contains($type, ['timestamp', 'datetime']):
                $rule = 'datetime';
                break;

            default:
                $rule = $type;
                break;
        }

        return $rule;
    }

    public static function drawComponent($column)
    {
        $name = Str::of($column->getName());
        $label = $name->absoluteTitle()->replaceLast(' Id', '');
        $element = collect();
        $script = collect();
        $attributes = [];
        $columnType = Str::of($column->getType()->getName());

        switch (true) {
            case $name->endsWith('_id'):
                $model = $name->replaceLast('_id', '')->plural();
                $function = "get{$model->ucfirst()}";
                $component = "BaseSelect ";
                $attributes[] = ":select-options=\"$model\" ";
                $getData = <<<TS
                const {$model} = ref();

                const {$function} = async () => {
                {$model}.value = await crudApi("{$model->singular()}").all();
                };

                {$function}();
                TS;
                $script->push($getData);
                break;
            case $columnType->contains(['text']):
                $component = "BaseInputTextArea ";
                break;
            case $columnType->contains(['text']):
                $component = "BaseInputTextArea ";
                break;
            case $columnType->contains(['text']):
                $component = "BaseInputTextArea ";
                break;
            case $columnType->contains(['bigint', 'int']):
                $component = "BaseInputText ";
                $attributes[] = 'type="numberic" ';
                break;
            case $columnType->contains(['smallint', 'boolean']):
                $component = "BaseSwitch ";
                $attributes[] = "id=\"input-{$name}\" ";
                break;
            case $columnType->contains(['datetime']):
                // $component = "BaseDateTimePicker ";
                $component = "BaseDatePicker ";
                break;
            case $columnType->contains(['date']):
                $component = "BaseDatePicker ";
                break;
            case $columnType->contains(['time']):
                $component = "BaseDatePicker ";
                break;

            default:
                $component = "BaseInputText ";
                break;
        }


        $element->push("\n<{$component} label=\"{$label}\" ");
        $element->push("\n\tv-model=\"modelValue.{$name}\" ");
        foreach ($attributes as $attr) {
            $element->push("\n{$attr}");
        }
        // $element->push("\n\t:error=\"model.getErrors('{$name}')\" ");
        $element->push("\n\tplaceholder=\"{$label}\" ");
        $element->push("\n\t:is-view-only=\"isViewOnly\" ");
        if ($column->getNotnull()) $element->push("\n\tis-required ");
        $element->push("\n/> ");

        return [
            'component' => $element->join(' '),
            'script' => $script->join("\n"),
        ];
    }

    public static function parseSwaggerExample($type)
    {

        switch (true) {
            case Str::contains($type, ['int', 'smallint', 'tinyint']):
                $example = 1;
                break;
            case Str::contains($type, ['tinyint']):
                $example = true;
                break;
            case Str::contains($type, ['date']):
                $example = '2020-01-01';
                break;
            case Str::contains($type, ['datetime']):
                $example = '2020-01-01 13:00:00';
                break;
            case Str::contains($type, ['timestamp']):
                $example = 1674241168;
                break;
            case Str::contains($type, ['boolean']):
                $example = true;
                break;

            default:
                $example = $type;
                break;
        }

        return $example;
    }

    public static function ruleLibrary($type)
    {
        return  [
            'image',
            'email',
            'string',
            'mimes:jpeg,bmp,png',
            'date',
            // 'datetime',
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
