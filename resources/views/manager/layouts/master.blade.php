<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/datatable/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/css/main.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="fixed-navbar">

    <div class="page-wrapper" id="app">
        <!-- START HEADER-->
        @include('manager.inc._navbar')
        <!-- END HEADER-->

        <!-- START SIDEBAR-->
        @include('manager.inc._sitebar')
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            @yield('content')

            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2018 © <b>Tutorsheba.com</b> - All rights reserved.</div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admins/datatable/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admins/js/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admins/js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('admins/js/app.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ asset('admins/js/custom.js') }}"></script>

    @yield('script')

</body>

</html>
