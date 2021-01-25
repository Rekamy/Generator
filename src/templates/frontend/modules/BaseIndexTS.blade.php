<?php
foreach ($modules as $module) :
    echo "export * from './$module';\n";
endforeach;
?>
<?= "
export default {
    install(Vue: any) {
        
        // Plugins expose
        //   Vue.config.globalProperties.jquery = jquery
        //   Vue.config.globalProperties.Swal = Swal
        //   Vue.config.globalProperties.http = axios

        // Vue.use(globalDirectives);a
        // Vue.use(SidebarPlugin);
        // Vue.use(NotificationPlugin);
    }
};
"