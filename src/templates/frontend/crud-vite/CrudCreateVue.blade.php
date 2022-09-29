<?= "
<template>
    <BaseCard title='Create $title'>
        <{$studly}Component :model='model' />
        <button type='submit' @click='submit'>Save</button>>
    </BaseCard>
</template>

<script setup lang='ts'>
    const model = ref(new {$studly}());

    const { create{$studly} } = use{$studly}Bloc();

    const submit = async () => {
        const res = await create{$studly}(model.value);
    };
</script>
" ?>