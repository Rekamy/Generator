<?= "
export class ${studly} {
    public id!: any;\n"?><?php
    foreach ($columns as $column) {
    $name = Str::of($column->getName());
    echo "\tpublic {$name}!: string;\n";
}?><?=" 
}

"
?>