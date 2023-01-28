<?php $routeToBase = "\$router.push('/{$slug}')" ?>
<?= "
<template>
  <BaseCard title=\"View {$title}\">
    <{$studly}Component :store=\"store\" is-view-only />
    <div class=\"d-flex flex-row-reverse\">
      <BaseButton color=\"danger mx-2\" @click=\"{$routeToBase}\">
        Back
      </BaseButton>
    </div>
  </BaseCard>
</template>

<script setup lang=\"ts\">
import type { {$studly} } from \"../blocs/model\"; 
import {$studly}Component from \"../components/{$studly}Component.vue\"; 

const store = useRepoStore<{$studly}>(\"{$slug}\");
const route = useRoute();
store.find(route.params.id as string);
</script>
" ?>
