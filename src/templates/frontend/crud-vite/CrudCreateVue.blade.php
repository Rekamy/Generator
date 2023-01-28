<?= "
<template>
  <BaseCard title=\"Create $title\">
    <{$studly}Component v-model=\"model\" />
    <div class=\"d-flex flex-row-reverse\">
      <BaseButton type=\"submit mx-2\" @click=\"submit\">Save</BaseButton>
      <BaseButton color=\"danger mx-2\" @click=\"\$router.go(-1)\">
        Cancel
      </BaseButton>
    </div>
  </BaseCard>
</template>

<script setup lang=\"ts\">
  import { useRepoStore } from \"@/core/repository-store\";
import {$studly}Component from \"../components/{$studly}Component.vue\"; 
import { {$studly} } from \"../blocs/model\"; 

const store = useRepoStore<{$studly}>("Endpoint.SERVICE_{$studly}");
const router = useRouter();

const submit = () => {
  store.save().then(() => {
    widget.alertSuccess(\"Berjaya!\", \"Rekod telah ditambah.\");
    router.replace(\"\");
  });
};
</script>
" ?>
