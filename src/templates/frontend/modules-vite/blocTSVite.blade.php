<?=
"
import type { Category } from \"./model\";

export function use${studly}Bloc() {
    async function get${studlyPlural}(query?: object) {
        return await crudApi<typeof ${studly}>(\"${slug}\").all(query);
    }

    async function get${studly}(id: ID, query?: object) {
        return await crudApi<typeof ${studly}>(\"${slug}\").find(id, query);
    }

    async function create${studly}(data: typeof ${studly}) {
        return await crudApi<typeof ${studly}>(\"${slug}\").create(data);
    }

    async function update${studly}(id: ID, data: any) {
        return await crudApi<typeof ${studly}>(\"${slug}\").update(id, data);
    }

    async function delete${studly}(id: ID) {
        return await crudApi<typeof ${studly}>(\"${slug}\").destroy(id);
    }

    return {
        get${studlyPlural},
        get${studly},
        create${studly},
        update${studly},
        delete${studly},
    };
}
"
?>
