<?=
"<!DOCTYPE html>
<html class=\"loading\" lang=\"en\" data-textdirection=\"ltr\">

<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui\">
    <meta name=\"description\" content=\"Student Management System\">
    <meta name=\"keywords\" content=\"Student Management System\">
    <meta name=\"author\" content=\"Student Management System\">
    <meta name=\"csrf-token\" content=\"{{ csrf_token() }}\">

    <title>{{ \$page ?? '' }}</title>
    <link rel=\"apple-touch-icon\" href=\"{{ asset('vendor/themes/app-assets/images/ico/apple-icon-120.png') }}\">
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"{{ asset('vendor/themes/app-assets/images/ico/favicon.ico') }}\">
    <link href=\"{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700\" rel=\"stylesheet') }}\">
    <!-- BEGIN VENDOR CSS-->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/vendors.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/charts/morris.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/extensions/unslider.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/weather-icons/climacons.min.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/extensions/bootstrap-treeview.min.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/tables/jsgrid/jsgrid-theme.min.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/tables/jsgrid/jsgrid.min.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/forms/selects/selectivity-full.min.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/extensions/sweetalert.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/vendors/css/forms/selects/select2.min.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css\">
    <script src=\"https://code.jquery.com/jquery-3.4.1.min.js\"></script>
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/app.css') }}\">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/core/menu/menu-types/vertical-content-menu.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/core/colors/palette-gradient.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/plugins/calendars/clndr.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/core/colors/palette-climacon.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/pages/users.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/app-assets/css/plugins/forms/selectivity/selectivity.css') }}\">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('vendor/themes/assets/css/style.css') }}\">
    <!-- END Custom CSS-->
    @stack('style')
</head>

<body class=\"vertical-layout vertical-content-menu 2-columns menu-expanded fixed-navbar\" data-open=\"click\" data-menu=\"vertical-content-menu\" data-col=\"2-columns\">

    <!-- <div class=\"preloader\"></div> -->

    @include('layouts.header')

    @include('layouts.nav')


    <style type=\"text/css\">
        .preloader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-image: url('vendor/themes/app-assets/images/default.gif');
            background-repeat: no-repeat;
            background-color: #FFF;
            background-position: center;
        }

        body {

            background-color: #eee;
        }

        table tr:nth-child(even) {
            background-color: #BEF2F5
        }

        .pagination li:hover {
            cursor: pointer;
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }
    </style>

    <div class=\"content-body\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"card\">
                    <div class=\"card-content\">
                        <div class=\"card-body\">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    </div>

    @include('layouts.footer')
    <!-- BEGIN VENDOR JS-->
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/vendors.min.js') }}\"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/ui/jquery.sticky.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/ui/headroom.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/extensions/jquery.knob.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/extensions/knob.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/charts/raphael-min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/charts/morris.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/extensions/unslider-min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/extensions/bootstrap-treeview.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/tables/jsgrid/jsgrid.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/tables/jsgrid/griddata.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/forms/select/selectivity-full.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/tables/datatable/datatables.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/extensions/sweetalert.min.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/vendors/js/forms/select/select2.full.min.js') }}\"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src=\"{{ asset('vendor/themes/app-assets/js/core/app-menu.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/core/app.js') }}\"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/ui/breadcrumbs-with-stats.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/extensions/tree-view.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/tables/jsgrid/jsgrid.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/forms/select/form-selectivity.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/tables/datatables/datatable-advanced.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/extensions/block-ui.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/extensions/sweet-alerts.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/tables/datatables/datatable-basic.js') }}\"></script>
    <script src=\"{{ asset('vendor/themes/app-assets/js/scripts/forms/select/form-select2.js') }}\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js\"></script>
    <script src=\"https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js\"></script>
    @stack('scripts')
    <!-- END PAGE LEVEL JS-->
</body>

</html>
<script>
    \$('select').addClass('select2');
    \$(window).on('load', function() {
        setTimeout(function() {
            \$('.preloader').fadeOut('slow');
        }, 0)
    });
    \$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': \$('meta[name=\"csrf-token\"]').attr('content')
        }
    });
</script>
"?>