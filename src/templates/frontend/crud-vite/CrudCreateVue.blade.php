<?= "
<template>
  <BaseCard title=\"Create $title\">
    <{$studly}Component :store=\"store\" />
    <div class=\"d-flex flex-row-reverse\">
      <BaseButton type=\"submit mx-2\" :disabled=\"store.hasError\" @click=\"submit\">
        Save
      </BaseButton>
      <BaseBackButton />
    </div>
  </BaseCard>
</template>

<script setup lang=\"ts\">
import {$studly}Component from \"../components/{$studly}Component.vue\"; 
import { {$studly}Schema } from \"../blocs/model\"; 

const store = useRepoStore(\"{$slug}\", {$studly}Schema);
store.model = {$studly}Schema.getDefault();

const router = useRouter();
const submit = () => {
  store.save().then(() => {
    widget.alertSuccess(\"Berjaya!\", \"Rekod telah ditambah.\");
    router.replace(\"/{$slug}\");
  });
};
</script>
" ?>
