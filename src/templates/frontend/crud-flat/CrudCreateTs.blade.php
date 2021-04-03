<?=
"
import { Vue, setup } from 'vue-class-component';
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";
import { widget } from \"@/core/utils/widget\";

export default class Create{$studly}Page extends Vue {
    {$camel}Bloc = setup(() => {$camel}Factory())
    $camel = new $studly

    async save() {
        this.{$camel} = await this.{$camel}Bloc.create{$studly}(this.{$camel});
        widget.alertSuccess('Good Job!', 'You have successfully created a $title');
        this.\$router.replace(`/crud/{$slug}/\${this.{$camel}.id}`)
    }
}

"
?>