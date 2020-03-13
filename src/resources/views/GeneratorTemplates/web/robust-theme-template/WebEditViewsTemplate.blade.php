<?="
<div class=\"modal fade\" id=\"baseAjaxModalContent\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"editModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
        <form method=\"POST\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"editModalLabel\">Edit " . ucfirst(Str::singular(str_replace('_', ' ', $tablename))) . "</h5>
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <div class=\"modal-body\">
                    @include('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . ".fields')
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
                    <button type=\"button\" class=\"btn btn-primary\" data-action=\"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".update', \$" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "->id) }}\" onClick=\"btnUpdate(this)\">Update Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . "/js/edit')
"?>