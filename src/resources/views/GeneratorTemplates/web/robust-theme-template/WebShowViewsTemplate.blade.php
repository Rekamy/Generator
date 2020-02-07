<?=
"@extends('layouts.app')
@section('content')

<div class=\"row match-height\">
    <div class=\"col-md-12\">
        <div class=\"card\">
            <div class=\"card-header\">
                <h4 class=\"card-title\" id=\"basic-layout-form-center\">Show " . ucfirst(Str::singular(str_replace('_', ' ', $tablename))) . "</h4>
            </div>
            <div class=\"card-content collapse show\">
                <div class=\"card-body\">
                    <div class=\"row justify-content-md-center\">
                        <div class=\"col-md-6\">
                            <div class=\"form-body\">
                                @include('" . lcfirst(Str::singular(Str::camel($tablename))) . ".fields')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@include('" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/js/show')

@endpush

"?>