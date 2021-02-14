import { createRouter, createWebHashHistory, RouteRecordRaw } from 'vue-router';
import crudRoutes from './crud'
import mainRoutes from './main'

let baseRoutes: Array<RouteRecordRaw> = [
    {
        path: '/',
        redirect: '/login',
    },
];

const merge: Array<RouteRecordRaw> = [];

const routes = baseRoutes
    .concat(mainRoutes)
    .concat(crudRoutes)

const router = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes
})

export default router
