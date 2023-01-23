<?php $router = '$router.go(-1)' ?>
<?= "
<template>
    <BaseCard title=\"Edit {$title}\">
        <{$studly}Component v-model=\"model\" />
        <div class=\"d-flex flex-row-reverse\">
            <BaseButton type=\"submit mx-2\" @click=\"submit\">Save</BaseButton>
            <BaseButton color=\"danger mx-2\" @click=\"{$router}\">
                Cancel
            </BaseButton>
        </div>    
    </BaseCard>
</template>

<script setup lang=\"ts\">
const model = ref(new {$studly}());
const route = useRoute();
const router = useRouter();

onMounted(async () => {
    model.value = await use{$studly}Bloc().get{$studly}(route.params.id as string);
});

const submit = () => {
    widget.showLoading();
    use{$studly}Bloc().update{$studly}(model.value.id, model.value).then(() => {
        widget.alertSuccess(\"Berjaya!\", \"Rekod telah dikemaskini.\");
        router.go(-1);
    });
};
</script>
" ?>
