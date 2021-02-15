<?=
"
import { Vue, setup } from 'vue-class-component';
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";
import { widget } from \"@/core/utils/widget\";

export default class Edit{$studly}Page extends Vue {
    {$camel}Bloc = setup(() => {$camel}Factory())
    $camel = new $studly

    async created() {
        this.{$camel}.id = this.\$route.params.id
        this.{$camel} = await this.{$camel}Bloc.get{$studly}(this.{$camel}.id);
    }

    async save() {
        try {
            // FIXME: method spoofing should overide from base api
            this.{$camel}._method = \"PUT\";
            this.$camel = await this.{$camel}Bloc.update{$studly}(this.{$camel});
            widget.alertSuccess('Good Job!', 'You have successfully edit this $title');
            this.\$router.push(`/crud/{$camel}/\${this.{$camel}.id}`)
        } catch (error) {
            widget.alertError(error);
        }
    }   
}

"
?>