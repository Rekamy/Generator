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
                    <a href=\"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".create') }}\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Add New {{ \$page }}</a>
                    <table class=\"table\">
                        <thead>
                            //
                        </thead>
                        <tbody>
                            //
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src=\"js/index.js\"></script>

<script type=\"text/javascript\">

$(document).ready(function () {
    let baseUrl = \"{{ route('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . ".index') }}\";
    get" . ucfirst(Str::camel($tablename)) . "(baseUrl);
});

</script>

@endsection
"?>