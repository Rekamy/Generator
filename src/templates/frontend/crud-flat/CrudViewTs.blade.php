<?=

"
import { defineComponent, ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { $studly, {$camel}Factory } from \"@/modules\";
import { widget } from \"@/core/utils\";

export default defineComponent({
    setup() {
        const route = useRoute();
        const { get{$studly}, destroy{$studly} } = {$camel}Factory();
        const $camel = ref(new $studly);
        {$camel}.value.id = route.params.id;

        onMounted(() => {
            {$camel}.value = await get{$studly}({$camel}.value.id);
        })

        const destroy = async (data: any) => {
            const router = useRouter();
            const { isConfirmed } = await widget.alertDelete()
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