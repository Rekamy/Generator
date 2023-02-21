<?php $router = '$router.go(-1)' ?>
<?= "
<template>
    <BaseCard title=\"Edit {$title}\">
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
const route = useRoute();
store.find(route.params.id as string);

const router = useRouter();
const submit = () => {
  store.save(route.params.id as string).then(() => {
    widget.alertSuccess(\"Berjaya!\", \"Rekod telah dikemaskini.\");
    router.go(-1);
  });
};
</script>
" ?>
