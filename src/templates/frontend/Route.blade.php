import { RouteRecordRaw } from 'vue-router';
import { Roles, Permissions } from '@/modules/auth';
import  BasePageComponents  from "@/components/layouts/base-page/index.vue";


const routes: Array<RouteRecordRaw> = [
@foreach ($routes as $name)
    {
        path: '/crud/{{ $name->slug() }}',
        name: 'crud.{{ $name }}',
        meta: { layout: "main", requiresAuth: true, breadcrumb: '{{ $name->replace('_', ' ')->title() }}' },
        component: BasePageComponents,
        children: [
            {
                path: '',
                name: 'crud.{{ $name }}.index',
                meta: { 
                    layout: "main", requiresAuth: true, breadcrumb: '{{ $name->replace('_', ' ')->title() }}',
                    //permissions: [Permissions.{{ $name }}_index] 
                    },
                component: () => import(/* webpackChunkName: "crud.{{ $name }}.index" */ '@/views/crud/{{ $name }}/index.vue'),
            },
            {
                path: ':id',
                name: 'crud.{{ $name }}.view',
                meta: { 
                    layout: "main", requiresAuth: true, breadcrumb: '{{ $name->slug() }}',
                    //permissions: [Permissions.{{ $name }}_show]
                    },
                component: () => import(/* webpackChunkName: "crud.{{ $name }}.view" */ '@/views/crud/{{ $name }}/view.vue'),
            },
            {
                path: 'create',
                name: 'crud.{{ $name }}.create',
                meta: { 
                    layout: "main", requiresAuth: true, breadcrumb: '{{ $name->slug() }}',
                    //permissions: [Permissions.{{ $name }}_create]
                    },
                component: () => import(/* webpackChunkName: "crud.{{ $name }}.create" */ '@/views/crud/{{ $name }}/create.vue'),
            },
            {
                path: ':id/edit',
                name: 'crud.{{ $name }}.edit',
                meta: { 
                    layout: "main", requiresAuth: true, breadcrumb: '{{ $name->slug() }}',
                    //permissions: [Permissions.{{ $name}}_update]
                    },
                component: () => import(/* webpackChunkName: "crud.{{ $name }}.edit" */ '@/views/crud/{{ $name }}/edit.vue'),
            },
        ]
    },
@endforeach
];

const crudMenusItem = [
@foreach ($routes as $name)
    {
        type: "menu",
        name: "{{ $name->studly() }}",
        route: "/crud/{{ $name->slug() }}",
        class: "ni ni-tv-2 text-primary",
    },
@endforeach
];

const crudMenus = [
    {
        type: "divider",
    },
    {
        type: "header",
        name: "CRUD",
    },
    {
        type: "parent",
        name: "Crud",
        class: "navbar-nav",
        childContainerClass: "nav-item",
        items: crudMenusItem,
    },
]


export { routes, crudMenus }
