<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, AdminWrap lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Xtreme admin lite design, Xtreme admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Xtreme Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <link href="{{ asset('Backend/dist/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield('head')

</head>


<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Preloader -->
    {{-- <div class="preloader" style="display: none;z-index: 100000;position: fixed;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10" />
        </svg>
    </div> --}}

    <!-- Error Modal for exception handling -->
    <div class="modal fade" id="divError" tabindex="-1" role="dialog" style="opacity: 1;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-body alert alert-danger" role="alert">
                <button class="close" type="button">�</button>
                <b>Alert!</b>
                <label id="lblError"></label>
            </div>
        </div>
    </div>

    <!-- Success Modal for exception handling -->
    <div class="modal fade" id="divSuccess" tabindex="-1" role="dialog" style="opacity: 1;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-body alert alert-success" role="alert" style="background: #0c9d00;">
                <button class="close" type="button">�</button>
                <b style="color: #033503;">Success!</b>
                <label id="lblSuccess"></label>
            </div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        @include('Backend.layouts.partials.header')
        @include('Backend.layouts.partials.sidemenu')

        <div class="page-wrapper">

            @yield('content')
            @include('Backend.layouts.partials.footer')

        </div>

    </div>

    <script src="{{ asset('Backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('Backend/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Backend/dist/js/app-style-switcher.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('Backend/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('Backend/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('Backend/dist/js/custom.js') }}"></script>
    <!--This page JavaScript -->

    <!-- helper.js created by shahbaz raza -->
    <script src="{{ asset('js/helper.js') }}"></script>
    {{-- <!-- app.js Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- "defer" is mandatory for vue element id="app" --> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('ServerError'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('ServerError') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    @stack('script')

</body>

</html>
