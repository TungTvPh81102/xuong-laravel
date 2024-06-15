<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title') | Outstock - Clean </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('client/assets/img/favicon.png') }}') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('client/assets/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/fontAwesome5Pro.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">

    @yield('style')
</head>

<body>
    <!-- Add your site or application content here -->

    <!-- prealoder area start -->
    @include('client.components.loading')
    <!-- prealoder area end -->

    <!-- header area start -->
    @include('client.layouts.header')
    <!-- header area end -->

    <!-- scroll up area start -->
    <div class="scroll-up" id="scroll" style="display: none;">
        <a href="javascript:void(0);"><i class="fas fa-level-up-alt"></i></a>
    </div>
    <!-- scroll up area end -->

    <!-- search area start -->
    @include('client.components.search-area')
    <div class="body-overlay transition-3"></div>
    <!-- search area end -->

    <!-- extra info area start -->
    @include('client.layouts.nav')
    <div class="body-overlay transition-3"></div>
    <!-- extra info area end -->

    <main>
        @yield('content')
    </main>

    <!-- footer area start -->
    @include('client.layouts.footer')
    <!-- footer area end -->

    <!-- JS here -->
    <script data-cfasync="false"
        src="{{ asset('client/../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/jquery-ui-slider-range.js') }}"></script>
    <script src="{{ asset('client/assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('client/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/main.js') }}"></script>

    @yield('script')
</body>

<!-- Mirrored from wphix.com/template/outstock-prv/outstock/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 May 2024 23:29:10 GMT -->

</html>
