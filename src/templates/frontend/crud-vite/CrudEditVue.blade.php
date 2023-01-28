<?php $router = '$router.go(-1)' ?>
<?= "
<template>
    <BaseCard title=\"Edit {$title}\">
        <{$studly}Component :store=\"store\" />
        <div class=\"d-flex flex-row-reverse\">
            <BaseButton type=\"submit mx-2\" @click=\"submit\">Save</BaseButton>
            <BaseBackButton />
        </div>    
    </BaseCard>
</template>

<script setup lang=\"ts\">
import {$studly}Component from \"../components/{$studly}Component.vue\"; 
import { {$studly}Schema, type {$studly} } from \"../blocs/model\"; 

const store = useRepoStore<{$studly}>(\"{$slug}\", {$studly}Schema);
const route = useRoute();
const router = useRouter();

store.find(route.params.id as string);

const submit = () => {
  store.save(route.params.id as string).then(() => {
    widget.alertSuccess(\"Berjaya!\", \"Rekod telah dikemaskini.\");
    router.go(-1);
  });
};
</script>
" ?>
