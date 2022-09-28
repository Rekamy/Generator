<?= "
<template>
    <div>
        <BaseTable :options='options'></BaseTable>
    </div>
</template>

<script scoped setup lang='ts'>

const { options } = use{$studly}Table();
</script>
" ?>