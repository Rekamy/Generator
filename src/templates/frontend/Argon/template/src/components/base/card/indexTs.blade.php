
import { Vue } from 'vue-class-component';

export default class Card extends Vue {
    public name: string = "card";
    public type: String = "";
    public gradient: String = "";
    public hover: Boolean = false;
    public shadow: Boolean = true;
    public shadowSize: String = "";
    public noBody: Boolean = false;
    public bodyClasses!: [String, Object, any[]];
    public headerClasses!: [String, Object, any[]];
    public footerClasses!: [String, Object, any[]];
}
