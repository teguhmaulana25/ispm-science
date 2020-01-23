<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dumet School">
    <meta name="author" content="Asvicode">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Favicon -->
    <link href="{{ asset('img/dsicon.ico') }}" rel="icon" type="image/png">
    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Exo:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,700i" rel="stylesheet">
    <!--Font Awesome Css -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome5/css/fontawesome-all.css') }}">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap_4/css/bootstrap.min.css') }}">
    @stack('css')
    <!-- Main Css -->
    <link href="{{ asset('css/fe.css?v=1.0.41') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('customer.includes.navbar')
        <main>
            @yield('content')
        </main>
    </div>
    <button class="top_scroll" style="display: block;"><i class="fa fa-chevron-up"></i></button>
    @include('customer.includes.footer')
</body>
<!-- jQuery 2.2.3 -->
<script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
@stack('script-top')
<!-- Bootstrap -->
<script type="text/javascript" src="{{ asset('plugins/bootstrap_4/js/bootstrap.min.js') }}"></script>
@stack('scripts')
<script type="text/javascript">
    //    top scroll
    $(".top_scroll").on('click', function () {
        $("html,body").animate({
            scrollTop: 0
        }, 500);
    });

    $(window).on('scroll',function () {
        var $scroll = $(this).scrollTop();
        if ($scroll >= 450) {
            $(".top_scroll").fadeIn();
        } else {
            $(".top_scroll").fadeOut();
        }
    });
</script>
</html>
