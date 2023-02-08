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

    public static function parseCast($type)
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
            case $type == 'date':
                $rule = 'date:Y-m-d';
                break;
            case $type == 'time':
                $rule = 'date:H:i';
                break;

            default:
                $rule = $type;
                break;
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
                $rule = 'date_format:Y-m-d H:i';
                break;
            case $type == 'date':
                $rule = 'date_format:Y-m-d';
                break;
            case $type == 'time':
                $rule = 'date_format:H:i';
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
        $options = json_decode($column->getComment(), true);
        $name = Str::of($column->getName());
        $label = !empty($options['label']) ? $options['label'] : $name->absoluteTitle()->replaceLast(' Id', '');
        $element = collect();
        $script = collect();
        $attributes = [];
        $columnType = !empty(data_get($options, 'type')) ? str(data_get($options, 'type')) : Str::of($column->getType()->getName());


        switch (true) {
            case $name->endsWith('_id') || !empty($options['ref']):
                if (!empty($options['ref'])) {
                    $studly = \Str::of($options['ref'])->studly();
                } else {
                    $studly = $name->replaceLast('_id', '')->studly();
                }
                $studly = $name->replaceLast('_id', '')->studly();
                $function = "get{$studly->plural()}";
                $component = "BaseSelect ";
                $attributes[] = ":select-options=\"{$studly->camel()}\" ";

                $getData = <<<TS
                const {$studly->camel()} = ref<any>([]);
                const {$function} = async () => {
                TS;

                $attributeName = !empty($options['refConfig']['value']) ? $options['refConfig']['value'] : "name";
                $getData .= <<<TS
                    {$studly->camel()}.value = await crudApi("{$studly->kebab()}").asSelection({
                        name: "$attributeName",
                    });
                };
                {$function}();\n
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
                $component = "BaseTimePicker ";
                break;
            case $columnType->contains(['attachment']):
                $component = "BaseUpload ";
                break;

            default:
                $component = "BaseInputText ";
                break;
        }

        if (!empty($options['component']['element'])) {
            $component = $options['component']['element'] . " ";
        }

        if (!empty($options['component']['attribute'])) {
            $attributes[] = $options['component']['attribute'];
        }

        $element->push("\n<{$component} label=\"{$label}\" ");
        $element->push("\n\tv-model=\"store.model.{$name}\" ");
        foreach ($attributes as $attr) {
            $element->push("\n{$attr}");
        }
        $element->push("\n\t:error=\"store.getError('{$name}')\" ");
        if (!empty($options['placeholder'])) {
            $element->push("\n\tplaceholder=\"{$options['placeholder']}\" ");
        } else {
            $element->push("\n\tplaceholder=\"{$label}\" ");
        }
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
            case Str::contains($type, ['datetime']):
                $example = '2020-01-01 13:00';
                break;
            case Str::contains($type, ['date']):
                $example = '2020-01-01';
                break;
            case Str::contains($type, ['time']):
                $example = '10:10';
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
        // TODO: add rule for time
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
