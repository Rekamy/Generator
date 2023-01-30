<?php
$nullable =  collect();
?>
<?= "
import type { JSONSchemaType } from 'ajv';

export interface ${studly} {
\tid?: ID;\n" ?>
<?php
    foreach ($columns as $column) {
        $name = Str::of($column->getName());
        if($column->getNotnull()) {
            $nullable->push("\"{$name}\"");
            echo "\t{$name}: string;\n";
        } else {
            echo "\t{$name}?: string;\n";
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
            $type = Str::contains($column->getType()->getName(), ['int', 'smallint', 'bigint']) ? 'number' : "string";
        }
        $isNullable = $column->getNotnull() ? ', minLength: 1 ' : ", nullable: true "; 
        echo "\t{$name}: { type: \"$type\"$isNullable },\n";
    }
    ?>
<?php $nulableList = $nullable->join(', '); ?>
<?="},
  required: [$nulableList],
  additionalProperties: false,
"?>
<?="}"?>
