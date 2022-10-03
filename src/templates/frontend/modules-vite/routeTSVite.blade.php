<?=
"
import BasePage from \"@/components/Base/BasePage.vue\";
import type { RouteRecordRaw } from \"vue-router\";

import Manage${studly} from \"./pages/Manage${studly}Page.vue\";
import Create${studly} from \"./pages/Create${studly}Page.vue\";
import View${studly} from \"./pages/View${studly}Page.vue\";
import Edit${studly} from \"./pages/Edit${studly}Page.vue\";

export default [
    {
        path: \"/${slug}\",
        name: \"${slug}\",
        component: BasePage,
        children: [
            {
                path: \"\",
                name: \"manage-${slug}\",
                component: Manage${studly},
            },
            {
                path: \"create\",
                name: \"create-${slug}\",
                component: Create${studly},
            },
            {
                path: \":id\",
                name: \"view-${slug}\",
                component: View${studly},
            },
            {
                path: \":id/edit\",
                name: \"edit-${slug}\",
                component: Edit${studly},
            },
        ],
    },
] as Array<RouteRecordRaw>;
" ?>