<?=
"
export function use${studly}Table() {
    const options = ref();

    return { options };
}

export function use${studly}Bloc() {
    function get${studly}s(query?: object) {
        //
    }

    function get${studly}<${studly}>(id: string, query?: object) {
        return new ${studly}();
    }

    function create${studly}(data: any) {
        return new ${studly}();
    }

    function update${studly}(id: string, data: any) {
        return new ${studly}();
    }

    function delete${studly}(id: string) {
        //
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