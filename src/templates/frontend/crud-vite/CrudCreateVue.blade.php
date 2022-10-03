<?php $router = '$router.go(-1)' ?>
<?= "
<template>
    <BaseCard title=\"Create $title\">
        <{$studly}Component :model=\"model\" />
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
const router = useRouter();

const submit = () => {
    widget.showLoading();
    use{$studly}Bloc().create{$studly}(model.value).then(() => {
        widget.alertSuccess(\"Berjaya!\", \"Rekod telah ditambah.\");
        router.replace(\"/{$slug}\");
    });
};
</script>
" ?>