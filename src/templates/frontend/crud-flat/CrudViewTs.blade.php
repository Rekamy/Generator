<?=

"
import { defineComponent, ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { $studly, {$camel}Factory } from \"@/modules\";
import { widget } from \"@/core/utils\";

export default defineComponent({
    setup() {
        const route = useRoute();
        const router = useRouter();
        const { get{$studly}, destroy{$studly} } = {$camel}Factory();
        const $camel = ref(new $studly);
        {$camel}.value.id = route.params.id;

        onMounted(async () => {
            {$camel}.value = await get{$studly}({$camel}.value.id);
        })

        const destroy = async () => {
            const { isConfirmed } = await widget.confirm()
            try {
                if (!isConfirmed) {
                    widget.alertSuccess('Deletion abort.', 'Your data is save.');
                    return;
                }
                await destroy{$studly}({$camel}.value.id);
                widget.alertSuccess('Good Job!', 'Your data has been deleted.');
                router.back();
            } catch (error) {
                throw error
            }
        }

        return { $camel, destroy }
    }

});
"
?>