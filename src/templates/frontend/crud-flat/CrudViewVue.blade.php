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
                            <div class=\"pl-lg-4\">
                                <div class=\"row\">" ?>
<?php foreach ($columns as $column) : ?>
<?= "
                                    <div class=\"col-lg-6\">
                                        <label class=\"label\">{$column->getName()}</label>
                                    </div>" ?>
<?php endforeach; ?>
<?= "
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class=\"footer pt-0\">
            <div class=\"row align-items-center justify-content-lg-between\">
                <div class=\"col-lg-6\">
                    <div class=\"copyright text-center  text-lg-left  text-muted\">
                        &copy; 2020 <a href=\"https://www.creative-tim.com\" class=\"font-weight-bold ml-1\"
                            target=\"_blank\">Creative Tim</a>
                    </div>
                </div>
                <div class=\"col-lg-6\">
                    <ul class=\"nav nav-footer justify-content-center justify-content-lg-end\">
                        <li class=\"nav-item\">
                            <a href=\"https://www.creative-tim.com\" class=\"nav-link\" target=\"_blank\">Creative Tim</a>
                        </li>
                        <li class=\"nav-item\">
                            <a href=\"https://www.creative-tim.com/presentation\" class=\"nav-link\" target=\"_blank\">About
                                Us</a>
                        </li>
                        <li class=\"nav-item\">
                            <a href=\"http://blog.creative-tim.com\" class=\"nav-link\" target=\"_blank\">Blog</a>
                        </li>
                        <li class=\"nav-item\">
                            <a href=\"https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md\"
                                class=\"nav-link\" target=\"_blank\">MIT License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</template>

<script lang=\"ts\" src=\"./view.ts\"></script>
"
?>