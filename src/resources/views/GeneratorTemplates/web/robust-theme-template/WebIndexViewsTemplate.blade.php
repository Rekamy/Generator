<?=
"@extends('layouts.app')
@section('content')

<div class=\"row\">
    <div class=\"col-12\">
        <div class=\"card\">
            <div class=\"card-header\">
                <h4 class=\"card-title\">List of {{ \$page }}</h4>
                <a class=\"heading-elements-toggle\"><i class=\"fa fa-ellipsis-v font-medium-3\"></i></a>
            </div>
            <div class=\"card-content collapse show\">
                <div class=\"card-body card-dashboard\">
                    @include('layouts.alert')
                    <a href=\"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".create') }}\" class=\"btn btn-primary pull-right\"><i class=\"fa fa-plus\"></i> Add New {{ \$page }}</a>
                    <table id=\"" . lcfirst(Str::singular(Str::camel($tablename))) . "Datatable\" class=\"display\" style=\"width:100%\">
                        <thead>
                            <tr>
                                " ?><?php
                                    foreach ($db->columns as $i => $column) {
                                        if ($column->TABLE_NAME == $tablename) {
                                            echo "<th>" . $column->COLUMN_NAME . "</th>\n\t\t\t\t\t\t\t\t";
                                        }
                                    } 
                                ?><?= "
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
                                        echo "<th>" . $column->COLUMN_NAME . "</th>\n\t\t\t\t\t\t\t\t";
                                    }
                                } 
                                ?><?= "
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@include('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . "/js/index')

@endpush

"?>