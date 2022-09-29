<?= "
<template>
    <BaseCard title='Update {$title}'>
        <{$studly}Component :model='model' />
    </BaseCard>
</template>

<script setup lang='ts'>
    const model = ref(new {$studly}());

    const { get{$studly} } = use{$studly}Bloc();

    // onMounted(async () => {
    //     const res = await get{$studly}('1');
    // });
</script>
" ?>