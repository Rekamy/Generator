import { RouteRecordRaw } from 'vue-router';

const crudRoutes: Array<RouteRecordRaw> = [
@foreach ($routes as $name)
    {
        path: '/crud/{{ $name }}',
        name: 'crud.{{ $name }}',
        meta: { layout: "main", requiresAuth: true, breadcrumb: '{{ $name->replace('_', ' ')->title() }}' },
        component: () => import(/* webpackChunkName: "crud.{{ $name }}" */ '@/views/crud/{{ $name }}/base.vue'),
        children: [
            {
                path: '',
                name: 'crud.{{ $name }}.index',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'List' },
                component: () => import(/* webpackChunkName: "crud.{{ $name }}.index" */ '@/views/crud/{{ $name }}/index.vue'),
            },
            {
                path: ':id',
                name: 'crud.{{ $name }}.view',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'View' },
                component: () => import(/* webpackChunkName: "crud.{{ $name }}.view" */ '@/views/crud/{{ $name }}/view.vue'),
            },
            {
                path: 'create',
                name: 'crud.{{ $name }}.create',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'Create' },
                component: () => import(/* webpackChunkName: "crud.{{ $name }}.create" */ '@/views/crud/{{ $name }}/create.vue'),
            },
            {
                path: ':id/edit',
                name: 'crud.{{ $name }}.edit',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'Edit' },
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
        name: "Crud{{ $name->studly() }}",
        route: "/crud/{{ $name->slug() }}",
        class: "ni ni-tv-2 text-primary",
    },
@endforeach
];

export default crudRoutes