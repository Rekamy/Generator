<?= "
import { $studly, {$studly}Bloc, ${camel}Store } from \"./index\"
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
    const ${camel} = ref([])

    onBeforeMount(() => {
        store.dispatch(`\${module}/init`)
        // console.log(store.get('${camel}'))
        ${camel}.value = store.state.${camel}.all
    })

    function init(): void {
        store.dispatch(`\${module}/init`)
    }

    function all(): [$studly] {
        return store.state.all
    }

    function first(id: number): $studly {
        return store.getters.module.first(id)
    }

    function create(${camel}: $studly): void {
        store.dispatch(`\${module}/create`, ${camel})
    }

    function update(id: number, request: $studly): void {
        ${camel}.value.forEach((${camel}: $studly) => {
            if (${camel}.id === id) {
                // ${camel}.name = request.name
                store.dispatch(`\${module}/update`, { id, request })
            }
        })
    }

    // FIXME: not working
    function destroy(id: number): void {
        // let ${camel} = ${camel}.value.filter((${camel}: $studly) => ${camel}.id === id)
        store.dispatch(`\${module}/destroy`, id)
    }

    return {
        state: store.state.${camel},
        init,
        all,
        first,
        create,
        update,
        destroy,
        ${camel},
    }

}

"