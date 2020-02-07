<?php echo "@extends('layouts.app')"; ?><?="
@section('content')
<div class=\"row\">
    <div class=\"col-12\">
        @include('layouts.alert')
        <div class=\"card\">
            <div class=\"card-header\">
                <h4 class=\"card-title\">List of Students</h4>
                <a class=\"heading-elements-toggle\"><i class=\"fa fa-ellipsis-v font-medium-3\"></i></a>
            </div>
            <div class=\"card-content collapse show\">
                <div class=\"card-body card-dashboard\">
                    <table class=\"table class\">
                        <thead>
                            <td>#</td>
                            <td>Student ID</td>
                            <td>Student Name</td>
                            <td>Total Absent</td>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
"?>