<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.meta')
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
</body>

</html>
