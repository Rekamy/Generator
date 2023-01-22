<?=
"
import BasePage from \"@/components/Base/BasePage.vue\";
import type { RouteRecordRaw } from \"vue-router\";

import Manage${studly}Page from \"./pages/Manage${studly}Page.vue\";
import Create${studly}Page from \"./pages/Create${studly}Page.vue\";
import View${studly}Page from \"./pages/View${studly}Page.vue\";
import Edit${studly}Page from \"./pages/Edit${studly}Page.vue\";

export default [
    {
        path: \"/${slug}\",
        name: \"${slug}\",
        component: BasePage,
        children: [
            {
                path: \"\",
                name: \"manage-${slug}\",
                component: Manage${studly}Page,
            },
            {
                path: \"create\",
                name: \"create-${slug}\",
                component: Create${studly}Page,
            },
            {
                path: \":id\",
                name: \"view-${slug}\",
                component: View${studly}Page,
            },
            {
                path: \":id/edit\",
                name: \"edit-${slug}\",
                component: Edit${studly}Page,
            },
        ],
    },
] as Array<RouteRecordRaw>;
" ?>
