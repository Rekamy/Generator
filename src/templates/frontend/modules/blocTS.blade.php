<?= "
import { $studly, {$studly}Bloc, ${camel}Store, ${camel}Api } from \"./index\"
import { ref, reactive, onBeforeMount, onUpdated } from \"vue\"
import { useStore } from \"vuex\"

export function {$camel}Factory(): ${studly}Bloc {
    const module = '${camel}'
    const store: any = useStore()
    const api = ${camel}Api
    const context = ref([])

    onBeforeMount(() => {
    })

    async function get{$studly->plural()}() : Promise<[$studly]> {
        let response = await api.all()
        return response.data.data;
    }

    async function get{$studly}(id: any): Promise<$studly> {
        let response = await api.first(id)
        return response.data;
    }

    async function create{$studly}(${camel}: $studly): Promise<$studly> {
        let response = await api.create(${camel})
        return response.data;
    }

    async function update{$studly}(${camel}: $studly): Promise<$studly> {
        let response = await api.edit(${camel}.id, ${camel})
        return response.data;
    }

    // FIXME: not working
    async function destroy{$studly}(id: any): Promise<void> {
        let response = await api.destroy(id)
        return response.data;
    }

    return {
        store,
        api,
        get{$studly->plural()},
        get{$studly},
        create{$studly},
        update{$studly},
        destroy{$studly},
    }

}

"