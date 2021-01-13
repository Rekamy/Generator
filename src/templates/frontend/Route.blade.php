import { RouteRecordRaw } from 'vue-router';

const crudRoutes: Array<RouteRecordRaw> = [
@foreach ($tables as $table)
    {
        path: '/crud/{{ Str::kebab(Str::studly($table)) }}',
        // name: 'Crud{{ Str::studly($table) }}',
        meta: { layout: "main", requiresAuth: true },
        component: () => import(/* webpackChunkName: "crud.{{ $table }}" */ '@/views/crud/{{ $table }}/{{ $table }}.vue'),
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