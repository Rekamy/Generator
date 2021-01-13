import { RouteRecordRaw } from 'vue-router';

const crudRoutes: Array<RouteRecordRaw> = [
@foreach ($tables as $table)
    {
        path: '/crud/{{ Str::kebab(Str::studly($table)) }}',
        // name: 'Crud{{ Str::studly($table) }}',
        meta: { layout: "main", requiresAuth: true },
        component: () => import(/* webpackChunkName: "crud.{{ $table }}" */ '@/views/crud/{{ $table }}/index.vue'),
    },
@endforeach
];
export default crudRoutes