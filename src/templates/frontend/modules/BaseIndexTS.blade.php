<?php
echo" 
export * from './auth';\n
export * from './user';\n
export * from './role';\n
export * from './permission';\n
export * from './reference';\n
";
foreach ($modules as $module) :
    echo "export * from './$module';\n";
endforeach;

?>
<?= "
export default {
    install(Vue: any) 
    {
    }
};
"
?>