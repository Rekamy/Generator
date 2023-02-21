<?php
$schema = collect();
foreach ($columns as $column) {
    $name = Str::of($column->getName());
    $rule = '';
    switch (true) {
        case $name->startsWith('is_'):
            $rule .= 'boolean()';
            break;
        case $name->endsWith('_id'):
            $rule .= 'string()';
            break;
        case Str::contains($column->getType()->getName(), ['integer', 'smallint', 'bigint']):
            $rule .= 'number()';
            break;
        default:
            $rule .= 'string()';
            break;
    }

    if($column->getNotnull()) {
        $rule .= '.required()';
    }

    $schema->push([
        'name' => $name,
        'rule' => $rule,
    ]);
}

?>
<?= "
import type { InferType } from \"yup\";\n" ?>
<?= "
export const ${studly}Schema = object({\n" ?>
<?php
foreach ($schema as $attribute) {
    echo $attribute['name'] . ': ' . $attribute['rule'] . ",\n";
}
?>
<?="});
export type ${studly} = InferType<typeof ${studly}Schema> & DynamicMap;
"?>
