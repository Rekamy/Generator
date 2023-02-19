<?php
$nullable =  collect();
?>
<?= "
import type { JSONSchemaType } from 'ajv';

export interface ${studly} {
  [key: string]: unknown;
\tid?: ID;\n" ?>
<?php
    foreach ($columns as $column) {
        $name = Str::of($column->getName());
        $rule = Str::contains($column->getType()->getName(), ['integer', 'smallint', 'bigint']) ? '"number"' : '"string"';
        $rule = $name->endsWith('_id') ? 'ID' : $rule;

        if($column->getNotnull()) {
            $nullable->push("\"{$name}\"");
            echo "\t{$name}: $rule;\n";
        } else {
            echo "\t{$name}?: $rule;\n";
        }
    }
?>
<?="}

export const ${studly}Schema: JSONSchemaType<${studly}> = {
    type: \"object\",
    properties: {
        id: { type: [\"string\", \"number\"], nullable: true },\n" ?>
<?php 
    foreach ($columns as $column) {
        $name = Str::of($column->getName());
        if(Str::of($name)->endsWith('_id')) {
            $type = '["number", "string"]';
        } else {
            $type = Str::contains($column->getType()->getName(), ['integer', 'smallint', 'bigint']) ? '"number"' : '"string"';
        }
        $isNullable = $column->getNotnull() ? 'minLength: 1 ' : "nullable: true "; 
        echo "\t{$name}: { type: $type, $isNullable },\n";
    }
    ?>
<?php $nulableList = $nullable->join(', '); ?>
<?="},
  required: [$nulableList],
  additionalProperties: true,
"?>
<?="}"?>
