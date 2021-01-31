<?=

"
import { Vue, setup } from 'vue-class-component';
import { $studly, {$studly}Bloc, {$camel}Factory } from \"@/modules/{$table->singular()}\";

export default class ViewDepartment extends Vue {
    {$camel}Bloc: {$studly}Bloc = setup(() => {$camel}Factory())
    $camel!: $studly

    async created() {
        console.log(this.\$route);
        let id = +this.\$route.params.id;
        this.$camel = await this.{$camel}Bloc.get{$studly}(id);
    }
}
"
?>