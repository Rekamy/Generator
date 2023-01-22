<?= "
<template>
    <div>"
    ?>
<?php
$chunk = array_chunk($columns->toArray(), 2);
for ($i = 0; $i < count($chunk); $i++) {?>
<?= "
        <div class=\"row\">"?>
<?php foreach ($chunk[$i] as $key => $column) {
        // dd($column->getNotnull());
        $name = Str::of($column->getName());
        $replaced = Str::replace('_', ' ', $name);
        $label = Str::of($replaced)->title();
        if($column->getNotnull()){?>
<?="
            <div class=\"col-6\">     
                <BaseInput label=\"{$label}\" placeholder=\"{$label}\" type=\"text\" v-model=\"model.{$name}\" required
                    :readonly=\"readonly\" /> 
            </div>\n"?>
<?php } else {?>
<?="
            <div class=\"col-6\">     
                <BaseInput label=\"{$label}\" placeholder=\"{$label}\" type=\"text\" v-model=\"model.{$name}\"
                    :readonly=\"readonly\" /> 
            </div>\n"?>
<?php } } ?>
<?="</div>"?>
<?php } ?>
<?= "</div>
</template>

<script setup lang=\"ts\">
defineProps([\"model\", \"readonly\"]);
</script>
" ?>
