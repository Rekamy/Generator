<?=
"@extends('layouts.app')
@section('content')

<div class=\"row match-height\">
    <div class=\"col-md-12\">
        <div class=\"card\">
            <div class=\"card-header\">
                <h4 class=\"card-title\" id=\"basic-layout-form-center\">Edit " . ucfirst(Str::singular(str_replace('_', ' ', $tablename))) . "</h4>
            </div>
            <div class=\"card-content collapse show\">
                <div class=\"card-body\">
                    <form class=\"form\" action=\"{{ route('" . lcfirst(Str::singular(Str::camel($tablename))) . ".update') }}\" method=\"POST\">
                        @csrf
                        @method('PUT')
                        <div class=\"row justify-content-md-center\">
                            <div class=\"col-md-6\">
                                <div class=\"form-body\">
                                    @include('" . lcfirst(Str::singular(Str::camel($tablename))) . ".fields')
                                </div>
                            </div>
                        </div>
                        <div class=\"form-actions center\">
                            <button type=\"button\" onClick=\"window.history.back()\" class=\"btn btn-warning mr-1\">
                                <i class=\"ft-x\"></i> Back
                            </button>
                            <button type=\"submit\" class=\"btn btn-info\">
                                <i class=\"fa fa-check-square-o\"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src=\"js/edit.js\"></script>

@endsection
"?>