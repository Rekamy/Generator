<?=
"
import BasePage from \"@/components/Base/BasePage.vue\";
import type { RouteRecordRaw } from \"vue-router\";

export default [
  {
    path: \"/${slug}\",
    name: \"${slug}\",
    component: BasePage,
    children: [
      {
        path: \"\",
        name: \"manage-${slug}\",
        component: () => import(\"./pages/Manage${studly}Page.vue\"),
      },
      {
        path: \"create\",
        name: \"create-${slug}\",
        component: () => import(\"./pages/Create${studly}Page.vue\"),
      },
      {
        path: \":id\",
        name: \"view-${slug}\",
        component: () => import(\"./pages/View${studly}Page.vue\"),
      },
      {
        path: \":id/edit\",
        name: \"edit-${slug}\",
        component: () => import(\"./pages/Edit${studly}Page.vue\"),
      },
    ],
  },
] as Array<RouteRecordRaw>;
" ?>
