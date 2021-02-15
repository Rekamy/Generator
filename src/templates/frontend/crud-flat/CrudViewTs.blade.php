<?=

"
import { Vue, setup } from 'vue-class-component';
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";
import { widget } from \"@/core/utils/widget\";

export default class View{$studly}Page extends Vue {
    {$camel}Bloc = setup(() => {$camel}Factory())
    $camel = new $studly

    async created() {
        this.{$camel}.id = +this.\$route.params.id;
        this.{$camel} = await this.{$camel}Bloc.get{$studly}(this.{$camel}.id);
    }

    async deleteData(data: any) {
        widget.alertDelete().then(async (result) => {
            try {
                if (!result.isConfirmed) {
                    widget.alertSuccess('Deletion abort.', 'Your data is save.');
                    return;
                }
                let message = await this.{$camel}Bloc.destroy{$studly}(this.{$camel}.id);
                widget.alertSuccess('Good Job!', 'Your data has been deleted.');
                this.\$router.replace('/crud/{$camel}');
            } catch (error) {
                widget.alertError(error);
            }
        })
    }
}
"
?>