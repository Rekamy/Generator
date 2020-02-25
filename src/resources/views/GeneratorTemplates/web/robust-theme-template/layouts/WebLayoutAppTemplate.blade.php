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
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/buttons/1.4.2/css/mixins.scss\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/buttons/1.4.2/css/common.scss\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap4.min.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css\">

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

    <div id=\"baseAjaxModal\"></div>

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
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0em 0em;
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

    <div class=\"baseAjaxModal\"></div>
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
    <script src=\"https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js\"></script>
    <script src=\"https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js\"></script>
    <script src=\"https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js\"></script>
    <script src=\"https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js\"></script>
    <script src=\"https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js\"></script>
    <script src=\"https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js\"></script>
    <script src=\"https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@9\"></script>
    @stack('scripts')
    <!-- END PAGE LEVEL JS-->
</body>

</html>
<script>
    \$('select').not('.defaultDOM').select2({
        width: '100%'
    });

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

    confirmDelete = (elem) => {
        return Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fc0330',
            cancelButtonColor: '#999',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        })
    }

    confirmCreate = (elem) => {
        return Swal.fire({
            title: 'Are you sure?',
            text: 'Data will be stored in the database!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#038cfc',
            cancelButtonColor: '#999',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        })
    }

    
    confirmDelete = (elem) => {
        return Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fc0330',
            cancelButtonColor: '#999',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        })
    }

    deleteItem = (elem, successCallback = () => {}, failCallback = () => {}) => {
        $.ajax({
            url: elem.dataset.action,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: true,
                    }).then(() => {
                        $(elem).closest('table').DataTable().ajax.reload()
                        successCallback()
                    });
                }
            },
            fail: (response) => {
                Swal.fire(
                    'Opps!',
                    'An error occur, we are sorry for inconvenience',
                    'danger'
                )
                failCallback()
            }
        })
    }

    processDeletion = (elem, successCallback, failCallback) => {
        Swal.fire({
            title: 'Data is being processed. Please wait...',
            onOpen: function() {
                Swal.showLoading();
                confirmDelete(elem).then((choice) => {
                    if (choice.value) {
                        deleteItem(elem, successCallback, failCallback)
                    } else {
                        Swal.fire(
                            'Canceled',
                            'Process has been canceled',
                            'info'
                        )
                    }
                })

            }
        })
    }

    processCreation = (elem, callback) => {
        Swal.fire({
            title: 'Data is being processed. Please wait...',
            onOpen: function() {
                Swal.showLoading();
                \$.ajax({
                    url: elem.dataset.action,
                    type: 'POST',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                            }).then(() => {
                                callback.DataTable().ajax.reload()
                            });
                        }
                    },
                    fail: (response) => {
                        Swal.fire(
                            'Opps!',
                            'An error occur, we are sorry for inconvenience',
                            'danger'
                        )
                    }
                })
            }
        })
    }

    processUpdation = (elem, callback) => {
        Swal.fire({
            title: 'Data is being processed. Please wait...',
            onOpen: function() {
                Swal.showLoading();
                \$.ajax({
                    url: elem.dataset.action,
                    type: 'PUT',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                            }).then(() => {
                                callback.DataTable().ajax.reload()
                            });
                        }
                    },
                    fail: (response) => {
                        Swal.fire(
                            'Opps!',
                            'An error occur, we are sorry for inconvenience',
                            'danger'
                        )
                        failCallback()
                    }
                })
            }
        })
    }

    getModalContent = (elem) => {
        \$.get(elem.dataset.action, function(response) {
            \$(\"#baseAjaxModal\").html(response);
            \$(baseAjaxModalContent).modal(\"show\");
        });
    }
</script>
"?>