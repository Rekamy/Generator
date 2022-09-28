<?= "
<template>
    <div>" ?>
<?php foreach ($columns as $column) :
    $name = Str::of($column->getName());
?><?= "
        <BaseInput label='{$name->upper()}' placeholder='{$name->upper()}' type='text' v-model='model.{$name}' required></BaseInput>\n" ?>
<?php endforeach; ?><?= "
    </div>
</template>

<script setup lang='ts'>
    defineProps(['model']);
</script>
" ?>
