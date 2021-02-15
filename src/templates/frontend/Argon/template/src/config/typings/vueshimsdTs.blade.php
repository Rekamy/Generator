declare module '*.vue' {

// FIXME: removed due to hardcoded components contructor definition
// import type { DefineComponent } from 'vue'
// const component: DefineComponent<{}, {}, any>

// TODO: confirm lifespan of vue defineComponent constructor method
import { defineComponent } from "vue";
const component: ReturnType<typeof defineComponent>;

export default component
}
