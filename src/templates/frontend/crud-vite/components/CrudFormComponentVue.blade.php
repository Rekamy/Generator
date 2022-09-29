<?= "
<template>
    <div>" ?>
<?php foreach ($columns as $column) :
    $name = Str::of($column->getName());
    $replaced = Str::replace('_', ' ', $name);
    $label = Str::of($replaced)->title();
?><?= "
        <BaseInput label='{$label}' placeholder='{$label}' type='text' v-model='model.{$name}' required></BaseInput>\n" ?>
<?php endforeach; ?><?= "
    </div>
</template>

<script setup lang='ts'>
    defineProps(['model']);
</script>
" ?>
