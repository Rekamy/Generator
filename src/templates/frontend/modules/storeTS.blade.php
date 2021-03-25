<?= 
"
import { $studly } from './index'
import { store } from '@/core/services/store'
import { useStore } from 'vuex'



// state
const state = () => ({
    all: [],
})

// getters
const getters = {
    first: (state: any) => (id: number) => state.all.find((${camel}: any) => ${camel}.id === id)

}

// actions
const actions = {
    getAll({ commit }: any) {
    },

    init({ dispatch }: any) {
        dispatch('getAll')
    },

    first({ getters }: any, id: number): $studly {
        return getters.first(id)
    },

    create({ commit }: any, request: $studly) {
        commit('create', request)
    },

    update({ commit }: any, payload: { id: number, request: $studly }) {
        commit('update', payload)
    },

    destroy({ commit, getters }: any, id: number) {
        commit('destroy', id)
    },
}

// mutations
const mutations = {
    setAll(state: any, ${camel}s: [$studly]) {
        state.all = ${camel}s
    },

    create(state: any, ${camel}: $studly) {
        state.all.push(${camel})
    },

    update(state: any, payload: { id: number, request: $studly }) {

        state.all.map((${camel}: any) => {
            return ${camel}
        })
    },

    destroy(state: any, id: number) {
        state.all = state.all.filter((${camel}: $studly) => id !== ${camel}.id)
        console.log(state.all);
    },

}

const module = {
    namespaced: true,
    state,
    actions,
    mutations,
    getters,
};

// export default
store.registerModule('${camel}', module);

const ${camel}Store = store;
export { ${camel}Store }
"
?>