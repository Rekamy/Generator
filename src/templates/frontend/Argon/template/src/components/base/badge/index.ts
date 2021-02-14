

import { Vue, Options } from 'vue-class-component';

@Options({
    props: {
        // icon
    }
})
export default class Badge extends Vue {
    public name: string = "badge";
    public tag: string = "span";
    public rounded: Boolean = true;
    public circle: Boolean = false;
    public icon: String = "";
    public type: String = "default";
    public text: String = "";

}
