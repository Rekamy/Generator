<?="<script type=\"text/javascript\">
    let baseUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".index') }}\"

    $(document).ready(function () {
        $('#" . lcfirst(Str::singular(Str::camel($tablename))) . "Datatable').DataTable({
            'scrollX': true,
            'scrollY': '500px',
            'scrollCollapse': true,
            'pagingType': 'full_numbers',
            'serverSide': true,
            'processing': true,
            select: true,
            ajax: {
                url: baseUrl,
                method: 'GET',
                dataType: 'json',
                data: { _token: \"{{ csrf_token() }}\" },
                dataSrc: \"data\",
            },
            columns: [
                " ?><?php
                    foreach ($db->columns as $i => $column) {
                        if ($column->TABLE_NAME == $tablename) {
                            echo "{ \"data\" : \"" . $column->COLUMN_NAME . "\" },\n\t\t\t\t";
                        }
                    } 
                ?><?= "
            ]
        });
    });
</script>
"?>