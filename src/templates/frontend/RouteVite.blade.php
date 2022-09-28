import {
createRouter,
createWebHistory,
createWebHashHistory,
} from "vue-router";
import type { RouteRecordRaw } from "vue-router";
// import path from "path";

import homeRoutes from "@/modules/home/router";
import exampleRoutes from "@/modules/crud/router";
<?php
foreach ($routes as $module) :
    // echo $module;
    echo "import " . $module['camel'] . "Routes from '@/modules/" . $module['kebab'] . "/router';\n";
//  "Routes from './module/$module/router';\n";
endforeach;

?>

<?=
"const baseRoutes: Array<RouteRecordRaw> = [
    ...homeRoutes,
    ...exampleRoutes,
"
?>
<?php
foreach ($routes as $module) :
    echo "    ..." . $module['camel'] . "Routes,\n";
endforeach;
?>
<?=
"];"
?>

const routes = baseRoutes;

// TODO: try https://www.npmjs.com/package/require-context
// const routeFiles = require.context("@/modules/home", true, /\router.ts$/);

// // const routes: Array<RouteRecordRaw> = [];
    // routes.push(...baseRoutes);
    // routeFiles.keys().forEach((key) => {
    // console.log(key);
    // const name: string = path.basename(key, ".ts");
    // const routeList = routeFiles(key).routes;
    // // if (routeList) routeList.forEach((element) => routes.push(element));
    // });

    const router = createRouter({
    history: createWebHistory("/vuetest"),
    routes,
    });

    export default router;