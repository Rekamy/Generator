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
import {$studly}Component from \"../components/{$studly}Component.vue\"; 
import { {$studly} } from \"../blocs/model\"; 
import { use{$studly}Bloc } from \"../blocs/bloc\"; 

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
