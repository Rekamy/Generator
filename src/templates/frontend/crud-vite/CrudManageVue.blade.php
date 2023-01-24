<?= "
<template>
  <BaseCard header-title=\"{$studly}\">
    <template #actionButton>
      <RouterLink class=\"btn btn-sm btn-success\" to=\"/{$slug}/create\">
        Add {$studly}
      </RouterLink>
    </template>
    <DataTable
        ref=\"tableRef\"
        :options=\"options\"
    />
  </BaseCard>
</template>

<script scoped setup lang=\"ts\">
const tableRef = ref()
const { options } = use{$studly}Table(\"tableRef\");
</script>
" ?>
