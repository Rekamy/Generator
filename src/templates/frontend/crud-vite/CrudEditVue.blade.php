<?="
<template>
    <BaseCard title='Update {$title}'>
        <{$studly}Component v-model='model' />
        <button type='submit' @click='submit'>Save</button>>
    </BaseCard>
</template>

<script setup lang='ts'>
const model = ref(new {$studly}());

const { get{$studly}, update{$studly} } = use{$studly}Bloc();

onMounted(async () => {
    const res = await get{$studly}('1');
    model.value.name = res.name;
});

const submit = async () => {
    const res = await update{$studly}('1', model);
};
</script>
"?>
