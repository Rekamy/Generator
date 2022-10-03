<?= "
<template>
    <BaseCard title=\"{$studly}\">
        <template #actionButton>
            <RouterLink class=\"btn btn-sm btn-success\" to=\"/{$slug}/create\">
                Add {$studly}
            </RouterLink>
        </template>
        <BaseTable
                id=\"{$slug}\"
                :options=\"options\"
        ></BaseTable>
    </BaseCard>
</template>

<script scoped setup lang=\"ts\">
const { options } = use{$studly}Table(\"{$slug}\");

</script>
" ?>