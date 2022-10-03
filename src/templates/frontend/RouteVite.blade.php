<?= "
const crudMenusItem = ["?>
<?php foreach ($routes as $key => $route) {
echo "\t
    {
        type: \"menu\",
        name: \"{$route['title']}\",
        route: \"/{$route['kebab']}/\",
        class: \"ni ni-tv-2 text-primary\",
    },";}
?>
<?= "
];

export default [
    {
        id: \"crudMenu\",
        type: \"parent\",
        class: \"navbar-nav\",
        name: \"Crud\",
        href: \"#crudMenu\",
        childContainerClass: \"nav-item\",
        items: crudMenusItem,
        // permissions: Permissions.setting_manage_setting,
    },
];
" ?>