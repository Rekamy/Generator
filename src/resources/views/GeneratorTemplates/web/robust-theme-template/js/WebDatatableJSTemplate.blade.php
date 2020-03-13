<?="<script type=\"text/javascript\">
    let baseUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".index') }}\";
    let createUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".create') }}\";

    \$(document).ready(function () {
        \$('#" . lcfirst(Str::singular(Str::camel($tablename))) . "Datatable').DataTable({
            'scrollX': true,
            'scrollY': '500px',
            'scrollCollapse': true,
            'pagingType': 'full_numbers',
            'serverSide': true,
            'processing': true,
            'ordering': false,
            dom: '<\"row\"<\"col-md-3\"l><\"col-md-6\"B><\"col-md-3\"f>>t<\"row\"<\"col-md-6\"i><\"col-md-6\"p>>',
            buttons: [{
                    text: 'Create',
                    attr:  {
                        \"data-action\": createUrl,
                        \"onClick\": \"getModalContent(this)\",
                    }
                },
                'excel', 'pdf', 'colvis'
            ],
            ajax: {
                url: baseUrl,
                method: 'GET',
                dataType: 'json',
                dataSrc: \"data\",
            },
            columns: [
                "?><?php
                    $int = 0;
                    foreach ($db->columns as $i => $column) {
                        if ($column->TABLE_NAME == $tablename) {
                            $int++;
                    ?><?="{ \"data\" : \"" . $column->COLUMN_NAME . "\" }, \n"?>
                <?php } } ?><?="
            ],
            columnDefs: [{
                \"targets\": " . $int . ",
                \"data\": 'id',
                \"render\": function(id, type, full, meta) {
                    let showUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".show', 'data-id') }}\";                    
                    let editUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".edit', 'data-id') }}\";
                    let deleteUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".destroy', 'data-id') }}\";

                    showUrl = showUrl.replace('data-id', id);
                    editUrl = editUrl.replace('data-id', id);
                    deleteUrl = deleteUrl.replace('data-id', id);

                    return '<div class=\"form-group\">' +
                    '<div class=\"btn-group\" role=\"group\">' +
                    '<button type=\"button\" data-action=\"' + showUrl + '\" class=\"btn btn-icon btn-outline-info\" onClick=\"getModalContent(this)\"><i class=\"fa fa-search\"></i></button>' +
                    '<button type=\"button\" data-action=\"' + editUrl + '\" class=\"btn btn-icon btn-outline-primary\" onClick=\"getModalContent(this)\"><i class=\"fa fa-edit\"></i></button>' +
                    '<button type=\"button\" data-action=\"' + deleteUrl + '\" class=\"btn btn-icon btn-outline-danger\" onClick=\"btnDelete(this)\"><i class=\"fa fa-trash\"></i></button>' +
                    '</div>' +
                    '</div>'
                }
            }]
        });

        btnDelete = (elem) => {
            processDeletion(elem)
        }

    });
</script>
"?>