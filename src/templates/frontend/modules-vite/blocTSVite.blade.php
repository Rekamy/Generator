<?=
"
export function use${studly}Bloc() {
    async function get${studly}s<${studly}>(query?: object) {
        return await crudApi<${studly}>(\"crudstaff/${slugPlural}\").all();
    }

    async function get${studly}<${studly}>(id: string, query?: object) {
        return await crudApi<${studly}>(\"crudstaff/${slugPlural}\").find(id);
    }

    async function create${studly}<${studly}>(data: ${studly}) {
        return await crudApi<${studly}>(\"crudstaff/${slugPlural}\").create(data);
    }

    async function update${studly}<${studly}>(id: string, data: any) {
        return await crudApi<${studly}>(\"crudstaff/${slugPlural}\").update(id, data);
    }

    async function delete${studly}<${studly}>(id: string) {
        return await crudApi<${studly}>(\"crudstaff/${slugPlural}\").destroy(id);
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