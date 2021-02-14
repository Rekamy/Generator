import { RouteRecordRaw } from 'vue-router';

const mainRoutes: Array<RouteRecordRaw> = [
    {
        path: '/login',
        name: 'Login',
        meta: { layout: "login" },
        component: () => import(/* webpackChunkName: "login" */ '@/views/auth/login/login.vue'),
    },
    {
        path: '/register',
        name: 'Register',
        meta: { layout: "login"},
        component: () => import(/* webpackChunkName: "register" */ '@/views/auth/register/register.vue'),
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        meta: { layout: "main", requiresAuth: true },
        component: () => import(/* webpackChunkName: "dashboard" */ '@/views/Dashboard/Dashboard.vue'),
    },
    
];
export default mainRoutes
