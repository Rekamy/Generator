<?="
<div class=\"modal fade\" id=\"baseAjaxModalContent\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"showModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"showModalLabel\">Show " . ucfirst(Str::singular(str_replace('_', ' ', $tablename))) . "</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            <div class=\"modal-body\">
                @include('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . ".fields')
            </div>
        </div>
    </div>
</div>

@include('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . "/js/show')
"?>