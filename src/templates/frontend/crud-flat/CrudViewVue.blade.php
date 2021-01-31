<?=
"
<template>
    <div class=\"container-fluid mt--6\">
        <div class=\"row\">
            <div class=\"col-xl-12 order-xl-1\">
                <div class=\"card\">
                    <div class=\"card-header\">
                        <div class=\"row align-items-center\">
                            <div class=\"col-8\">
                                <h3 class=\"mb-0\">{$title->singular()} : 1</h3>
                            </div>
                        </div>
                    </div>
                    <div class=\"card-body\">
                        <h6 class=\"heading-small text-muted mb-4\">Details</h6>
                        <div class=\"row\">
                            <div class=\"pl-lg-4 my-2\">
                        " ?>
<?php foreach ($columns as $column) : 
    $name = Str::of($column->getName())->singular();
?><?= "
                                <div class=\"row\">
                                    <div class=\"col-lg-4 small\">{$name->studly()}</div>
                                </div>
                                <div class=\"row\">
                                    <div class=\"col-lg-4 ml-4\">{{ {$camel}?.{$name->camel()} }}</div>
                                </div>" ?>
<?php endforeach; ?><?= "
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang=\"ts\" src=\"./view.ts\"></script>
"
?>