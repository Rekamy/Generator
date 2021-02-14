const crudMenusItem = [
    {
        type: "menu",
        name: "Kertas Pertuduhan",
        route: "/crud/charges",
        class: "ni ni-tv-2 text-primary",
    },
];

const crudMenusItem = [
@foreach ($tables as $table)
    {
        type: "menu",
        name: "Crud{{ Str::studly($table) }}",
        route: "/crud/{{ Str::kebab(Str::studly($table)) }}",
        class: "ni ni-tv-2 text-primary",
    },
@endforeach
];

const devMenus = [
    {
        type: "divider",
    },
    {
        type: "header",
        name: "Crud",
    },
    {
        type: "single",
        class: "navbar-nav",
        childContainerClass: "nav-item",
        items: crudMenusItem,
    },
];

export default devMenus;
