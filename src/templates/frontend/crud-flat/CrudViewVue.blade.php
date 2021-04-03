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
                                <h3 class=\"mb-0\">{$title}</h3>
                            </div>
                        </div>
                    </div>
                    <div class=\"card-body\">
                        <form>
                            <h6 class=\"heading-small text-muted mb-4\">Details</h6>
                            <div class=\"pl-lg-4\">" ?>
<?php foreach ($columns as $column) : 
    $name = Str::of($column->getName());
?><?= "
                                <div class=\"col-lg-6\">
                                    <div class=\"form-group\">
                                        <label class=\"form-control-label\" for=\"view-{$camel}-{$name}\">{$name->studly()}</label>
                                        <input type=\"text\" :value=\"{$camel}.{$name}\" id=\"view-{$camel}-{$name}\" class=\"form-control\" readonly>
                                    </div>
                                </div>" ?>
<?php endforeach; ?><?= "
                            </div>
                            <hr class=\"my-4\" />
                            <div class=\"col text-right\">
                                <button type=\"button\" @click=\"\$router.push(`/crud/$slug/\${{$camel}.id}/edit`)\" class=\"btn btn-primary\">Update</button>
                                <button type=\"button\" @click=\"deleteData\" class=\"btn btn-danger\">Delete</button>
                                <button type=\"button\" @click=\"\$router.back()\" class=\"btn btn-default\">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script scoped lang=\"ts\" src=\"./view.ts\"></script>
"
?>