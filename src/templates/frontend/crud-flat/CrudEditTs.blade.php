<?=
"
import { Vue, setup } from 'vue-class-component';
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";

export default class Edit{$studly} extends Vue {
    {$camel}Bloc = setup(() => {$camel}Factory())
    $camel = new $studly

    async created() {
        this.{$camel}.id = +this.\$route.params.id
        this.{$camel} = await this.{$camel}Bloc.get{$studly}(this.{$camel}.id);
    }

    async save() {
        this.{$camel}._method = \"PUT\";
        this.$camel = await this.{$camel}Bloc.update{$studly}(this.{$camel});
    }   
}

"
?>