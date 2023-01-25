<?=
"
import type { ${studly} } from \"./model\";

export function use${studly}Bloc() {
    async function get${studlyPlural}(query?: object) {
        return await crudApi<${studly}>(\"${slug}\").all(query);
    }

    async function get${studly}(id: ID, query?: object) {
        return await crudApi<${studly}>(\"${slug}\").find(id, query);
    }

    async function create${studly}(data: ${studly}) {
        return await crudApi<${studly}>(\"${slug}\").create(data);
    }

    async function update${studly}(id: ID, data: ${studly}) {
        return await crudApi<${studly}>(\"${slug}\").update(id, data);
    }

    async function delete${studly}(id: ID) {
        return await crudApi<${studly}>(\"${slug}\").destroy(id);
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
