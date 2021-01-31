<?= "
import { $studly, {$studly}Bloc, ${camel}Store, ${camel}Api } from \"./index\"
import { ref, reactive, onBeforeMount, onUpdated } from \"vue\"
import { useStore } from \"vuex\"

/**
 * DepartmentFactory to instantiate ${studly}Bloc instance.
 *
 * Example with vue-class-components composition API:
 * ```
 * import { Vue, setup } from \"vue-class-component\";
 * import { ${camel}Factory, ${studly}Bloc } from \"@/services/bloc/index\";
 *
 * class ComponentA extends Vue {
 *     ${camel}Bloc: ${studly}Bloc = setup(() => ${camel}Factory())
 * }
 * ```
 */
export function {$camel}Factory(): ${studly}Bloc {
    const module = '${camel}'
    const store: any = useStore()
    const api = ${camel}Api
    const context = ref([])

    onBeforeMount(() => {
        // check module authorization

        // store.dispatch(`\${module}/init`)
        // console.log(store.get('${camel}'))
        // context.value = store.state.${camel}.all
    })

    async function get{$studly->plural()}() : Promise<[$studly]> {
        let response = await api.all()
        return response.data.data;
        // return store.state.all
    }

    async function get{$studly}(id: number): Promise<$studly> {
        let response = await api.first(id)
        return response.data;
        // return store.getters.module.first(id)
    }

    async function create{$studly}(${camel}: $studly): Promise<$studly> {
        let response = await api.create(${camel})
        return response.data.data;
        // store.dispatch(`\${module}/create`, ${camel})
        // return store.getters.module.first(id)
    }

    async function update{$studly}(${camel}: $studly): Promise<$studly> {
        let response = await api.edit(${camel}.id, ${camel})
        return response.data.data;
        // store.dispatch(`\${module}/create`, ${camel})
        // return store.getters.module.first(id)
        // context.value.forEach((${camel}: ${studly}) => {
        //     if (${camel}.id === id) {
        //         // ${camel}.name = request.name
        //         store.dispatch(`\${module}/update`, { id, request })
        //     }
        // })
    }

    // FIXME: not working
    async function destroy{$studly}(id: number): Promise<void> {
        // let ${camel} = ${camel}.value.filter((${camel}: ${studly}) => ${camel}.id === id)
        let response = await api.destroy(id)
        return response.data.data;
        // store.dispatch(`\${module}/destroy`, id)
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