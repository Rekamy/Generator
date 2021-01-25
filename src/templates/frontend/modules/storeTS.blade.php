<?= 
"
import { $studly, ${studly}Bloc, ${camel}Api } from './index'
import { store } from '@/services/store'
import { useStore } from 'vuex'



// state
const state = () => ({
    all: [],
})

// getters
const getters = {
    // all: (state: any) => (id: number) => state.all,
    first: (state: any) => (id: number) => state.all.find((${camel}: any) => ${camel}.id === id)

}

// actions
const actions = {
    getAll({ commit }: any) {
        commit('setAll', [
            { id: 1, name: 'JABATAN UNDANG UNDANG' },
            { id: 2, name: 'DIREKTORAT PENGUATKUASAAN' },
            { id: 3, name: 'KESIHATAN' },
            { id: 4, name: 'KEJURUTERAAN' },
            { id: 5, name: 'PERLESENAN' },
            { id: 6, name: 'BANGUNAN' },
            //ajax get data
        ])
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

    // destroy({ commit, getters }: any) {
    destroy({ commit, getters }: any, id: number) {
        // let ${camel} = getters.first(id)
        commit('destroy', id)
        // return true
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
            if (${camel}.id === payload.id) ${camel}.name = payload.request.name
            return ${camel}
        })
    },

    // FIXME: not working
    destroy(state: any, id: number) {
        // console.log(state.all);
        state.all = state.all.filter((${camel}: $studly) => id !== ${camel}.id)
        console.log(state.all);
        // state.all.shift()
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

const ${camel}Store = useStore();
export { ${camel}Store }
// export { ${camel}Store };
"