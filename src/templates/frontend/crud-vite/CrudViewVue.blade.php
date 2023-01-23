<?php $router = "\$router.push('/{$slug}')" ?>
<?= "
<template>
  <BaseCard title=\"View {$title}\">
    <{$studly}Component v-model=\"model\" readonly />
    <div class=\"d-flex flex-row-reverse\">
      <BaseButton color=\"danger mx-2\" @click=\"{$router}\">
        Back
      </BaseButton>
    </div>
  </BaseCard>
</template>

<script setup lang=\"ts\">
const model = ref(new {$studly}());
const route = useRoute();

onMounted(async () => {
  model.value = await use{$studly}Bloc().get{$studly}(route.params.id as string);
});
</script>
" ?>
