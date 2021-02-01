<?=
"
import { Vue, setup } from 'vue-class-component';
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";
import Swal from 'sweetalert2';

export default class CreateCharges extends Vue {
    {$camel}Bloc = setup(() => {$camel}Factory())
    $camel = new $studly

    async save() {
        await this.{$camel}Bloc.create{$studly}({$camel});
    }
}

"
?>