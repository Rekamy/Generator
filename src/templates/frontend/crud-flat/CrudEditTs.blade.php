<?=
"
import { defineComponent, onMounted, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { $studly, {$camel}Factory } from \"@/modules/{$table}\";
import { widget } from \"@/core/utils/widget\";

export default defineComponent({
    setup() {
        const route = useRoute();
        const router = useRouter();
        const { update{$studly}, get{$studly} } = {$camel}Factory();
        const $camel = ref(new $studly);
        {$camel}.value.id = route.params.id

        onMounted(async () => {
            {$camel}.value = await get{$studly}({$camel}.value.id);
        })

        const save = async () => {
            {$camel}.value = await update{$studly}({$camel}.value);
            widget.alertSuccess('Good Job!', 'You have successfully edit this $title');
            router.back()
        }   

        return { $camel, save }
    }
    
});

"
?>