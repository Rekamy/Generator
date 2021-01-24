import { RouteRecordRaw } from 'vue-router';

const crudRoutes: Array<RouteRecordRaw> = [
@foreach ($tables as $table)
    {
        path: '/crud/{{ Str::kebab(Str::studly($table)) }}',
        name: '{{ Str::title($table) }}',
        meta: { layout: "main", requiresAuth: true },
        component: () => import(/* webpackChunkName: "crud.{{ $table }}" */ '@/views/crud/{{ $table }}/base.vue'),
        children: [
            {
                path: '/',
                name: 'list',
                component: () => import(/* webpackChunkName: "crud.{{ $table }}.index" */ '@/views/crud/{{ $table }}/index.vue'),
            },
            {
                path: '/view',
                name: 'View',
                component: () => import(/* webpackChunkName: "crud.{{ $table }}.view" */ '@/views/crud/{{ $table }}/view.vue'),
            },
            {
                path: '/crud/{{ Str::kebab(Str::studly($table)) }}/create',
                name: 'Create',
                meta: { layout: "main", requiresAuth: true },
                component: () => import(/* webpackChunkName: "crud.{{ $table }}.create" */ '@/views/crud/{{ $table }}/create.vue'),
            },
            {
                path: '/crud/{{ Str::kebab(Str::studly($table)) }}/edit',
                name: 'Edit',
                meta: { layout: "main", requiresAuth: true },
                component: () => import(/* webpackChunkName: "crud.{{ $table }}.edit" */ '@/views/crud/{{ $table }}/edit.vue'),
            },
        ]
    },
@endforeach
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

export default crudRoutes