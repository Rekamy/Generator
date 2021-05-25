<?php 
foreach ($imports as $import) {
    echo $import . "\n";
}
?>
<?= "
export class ${studly} {
    public id!: any;\n"
    ?><?php
    foreach ($columns as $column) {
        $name = Str::of($column->getName());
        echo "\tpublic {$name}!: string;\n";
    }

    foreach ($additionalAttributes as $name => $model) {
        echo "\tpublic {$name}: $model = new $model;\n";
    }

    foreach ($additionalArray as $name => $model) {
        echo "\tpublic {$name}: {$model}[] = [];\n";
    }
?><?=" 
}

"
?>