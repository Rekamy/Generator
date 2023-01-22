<?=
"
export function use${studly}Bloc() {
    async function get${studly}s<${studly}>(query?: object) {
        return await crudApi<${studly}>(\"${slug}\").all();
    }

    async function get${studly}<${studly}>(id: string, query?: object) {
        return await crudApi<${studly}>(\"${slug}\").find(id);
    }

    async function create${studly}<${studly}>(data: ${studly}) {
        return await crudApi<${studly}>(\"${slug}\").create(data);
    }

    async function update${studly}<${studly}>(id: string, data: any) {
        return await crudApi<${studly}>(\"${slug}\").update(id, data);
    }

    async function delete${studly}<${studly}>(id: string) {
        return await crudApi<${studly}>(\"${slug}\").destroy(id);
    }

    return {
        get${studly}s,
        get${studly},
        create${studly},
        update${studly},
        delete${studly},
    };
}
"
?>
