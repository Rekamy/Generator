<?=
"
<table id=\"" . lcfirst(Str::singular(Str::camel($tablename))) . "Datatable\" class=\"display\" style=\"width:100%\">
    <thead>
        <tr>
            " ?><?php
                foreach ($db->columns as $i => $column) {
                    if ($column->TABLE_NAME == $tablename) {
                        echo "<th>" . ucfirst(str_replace('_', ' ', $column->COLUMN_NAME)) . "</th>\n\t\t\t";
                    }
                } 
            ?>
<?="<th>Actions</th>"?>
            <?= "
        </tr>
    </thead>
    <tbody>
        <!-- -->
    </tbody>
    <tfoot>
        <tr>
            " ?><?php
            foreach ($db->columns as $i => $column) {
                if ($column->TABLE_NAME == $tablename) {
                    echo "<th>" . ucfirst(str_replace('_', ' ', $column->COLUMN_NAME)) . "</th>\n\t\t\t";
                }
            } ?>
<?="<th>Actions</th>"?>
            <?= "
        </tr>
    </tfoot>
</table>

@push('scripts')

@include('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . "/js/datatable')

@endpush

"?>