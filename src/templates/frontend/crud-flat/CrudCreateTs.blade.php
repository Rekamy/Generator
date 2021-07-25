<?=
"
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";
import { widget } from \"@/core/utils/widget\";

export default defineComponent({
    setup() {
        const { create{$studly} } = {$camel}Factory())
        const $camel = ref(new $studly)

        const save = async () => {
            const router = useRouter();
            {$camel}.value = await create{$studly}({$camel}.value);
            widget.alertSuccess('Good Job!', 'You have successfully created a $title');
            router.replace(`/crud/{$slug}/\${{$camel}.value.id}`);
        }

        return { $camel, save }
    }

});

"
?>