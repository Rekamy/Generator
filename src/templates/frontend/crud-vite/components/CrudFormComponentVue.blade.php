<?= "
<template>
    <div>"
    ?>
<?php
use Rekamy\Generator\Core\RuleParser;
$scripts = collect();
$chunk = array_chunk($columns->toArray(), 2);
for ($i = 0; $i < count($chunk); $i++) : ?>
<?= "
        <div class=\"row\">"?>
<?php foreach ($chunk[$i] as $key => $column) :
        $element = RuleParser::drawComponent($column);
        if(!empty($element['script'])) $scripts->push($element['script'])
?>
<?="
            <div class=\"col-6\">     
                {$element['component']}
            </div>\n"?>
<?php endforeach; ?>
<?="</div>"?>
<?php endfor; ?>
<?= "</div>
</template>

<script setup lang=\"ts\">
defineProps([\"modelValue\", \"isViewOnly\"]);

{$scripts->join("\n")}
</script>
" ?>
