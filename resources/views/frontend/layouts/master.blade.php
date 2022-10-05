<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.meta')
    @yield('meta_description')
    @include('frontend.assetLinks.css')
</head>

<body>
    @include('frontend.layouts.header')
    @include('frontend.layouts.navbar')

    <div class="wrapper">
        @yield('content')
        @include('frontend.layouts.footer')
    </div>

    @include('frontend.assetLinks.javascript')

    @yield('js')

    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
      </script>
</body>



</html>
