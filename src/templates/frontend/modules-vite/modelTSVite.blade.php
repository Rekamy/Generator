<?= "export class ${studly} {
\tpublic id!: ID;\n"
?>
<?php
    foreach ($columns as $column) {
        $name = Str::of($column->getName());
        echo "\tpublic {$name}!: string;\n";
    }

    foreach ($additionalAttributes as $name => $model) {
        echo "\tpublic {$name}: any;\n";
    }

    foreach ($additionalArray as $name => $model) {
        echo "\tpublic {$name}: any[] = [];\n";
    }
?>
<?="}"
?>
