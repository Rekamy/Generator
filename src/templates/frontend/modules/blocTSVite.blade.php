<?=
"
export function use${camel}Table() {
    const options = ref();

    return { options };
}

export function use${camel}Bloc() {
    function get${camel}s(query?: object) {
        //
    }

    function get${camel}<${camel}>(id: string, query?: object) {
        return new ${camel}();
    }

    function create${camel}(data: any) {
        return new ${camel}();
    }

    function update${camel}(id: string, data: any) {
        return new ${camel}();
    }

    function delete${camel}(id: string) {
        //
    }

    return {
        get${camel}s,
        get${camel},
        create${camel},
        update${camel},
        delete${camel},
    };
}
"

?>