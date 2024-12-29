<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ url('assets/') }}/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>Dashboard - Analytics | Materialize - Material Design HTML Admin Template</title>

    <meta name="description" content="" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/remixicon/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.6/datatables.min.css" rel="stylesheet">





    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css') }}" />
   

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @yield('css')

</head>

<body>
    <!-- Layout wrapper -->
    @yield('content')
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>


    {{-- Vendor Script --}}
    <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('assets/vendor/js/dropdown-hover.js')}}"></script>

    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/validate/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Page Script --}}
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.6/datatables.min.js"></script>
    {{-- <script src="{{asset('assets/js/tables-datatables-advanced.js')}}"></script> --}}
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      </script>
    @yield('js')

</body>

</html>
