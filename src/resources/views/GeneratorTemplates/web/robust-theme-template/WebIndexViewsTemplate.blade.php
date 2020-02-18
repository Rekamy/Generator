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
                    @include('" . lcfirst(Str::singular(str_replace('_', '-', $tablename))) . "/datatable')
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