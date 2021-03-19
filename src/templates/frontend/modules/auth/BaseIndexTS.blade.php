<?php
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