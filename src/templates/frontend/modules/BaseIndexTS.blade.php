<?php
echo" export * from './auth';\n";
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