<?=
"
import BasePage from '../../components/BasePage.vue';
import type { RouteRecordRaw } from 'vue-router';

import Manage${camel} from './pages/Manage${camel}Page.vue';
import Create${camel} from './pages/Create${camel}Page.vue';
import View${camel} from './pages/View${camel}Page.vue';
import Edit${camel} from './pages/Edit${camel}Page.vue';

export default [
    {
        path: '/${slug}',
        name: '${slug}',
        component: BasePage,
        children: [
            {
                path: '/',
                name: 'manage-${slug}',
                component: Manage${camel},
            },
            {
                path: '/create',
                name: 'create-${slug}',
                component: Create${camel},
            },
            {
                path: '/{id}',
                name: 'view-${slug}',
                component: View${camel},
            },
            {
                path: '/{id}/edit',
                name: 'edit-${slug}',
                component: Edit${camel},
            },
        ],
    },
] as Array<RouteRecordRaw>;
" ?>