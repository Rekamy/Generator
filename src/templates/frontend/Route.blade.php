import { RouteRecordRaw } from 'vue-router';

const crudRoutes: Array<RouteRecordRaw> = [
@foreach ($routes as $route)
    {
        path: '{{ $route['path'] }}',
        name: '{{ $route['name'] }}',
        meta: { layout: "main", requiresAuth: true, breadcrumb: '{{ $route['title'] }}' },
        component: () => import(/* webpackChunkName: "{{ $route['name'] }}" */ '@/views/crud/{{ $route['table'] }}/base.vue'),
        children: [
            {
                path: '',
                name: '{{ $route['name'] }}.index',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'List' },
                component: () => import(/* webpackChunkName: "{{ $route['name'] }}.index" */ '@/views/crud/{{ $route['table'] }}/index.vue'),
            },
            {
                path: 'view',
                name: '{{ $route['name'] }}.view',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'View' },
                component: () => import(/* webpackChunkName: "{{ $route['name'] }}.view" */ '@/views/crud/{{ $route['table'] }}/view.vue'),
            },
            {
                path: 'create',
                name: '{{ $route['name'] }}.create',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'Create' },
                component: () => import(/* webpackChunkName: "{{ $route['name'] }}.create" */ '@/views/crud/{{ $route['table'] }}/create.vue'),
            },
            {
                path: 'edit',
                name: '{{ $route['name'] }}.edit',
                meta: { layout: "main", requiresAuth: true, breadcrumb: 'Edit' },
                component: () => import(/* webpackChunkName: "{{ $route['name'] }}.edit" */ '@/views/crud/{{ $route['table'] }}/edit.vue'),
            },
        ]
    },
@endforeach
];

const crudMenusItem = [
@foreach ($routes as $route)
    {
        type: "menu",
        name: "Crud{{ Str::studly($route['table']) }}",
        route: "/crud/{{ Str::kebab(Str::studly($route['table'])) }}",
        class: "ni ni-tv-2 text-primary",
    },
@endforeach
];

export default crudRoutes