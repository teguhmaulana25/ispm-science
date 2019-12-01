<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" style="height: 100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Login</title>

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#263238">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#263238">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#263238">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">

    <!-- PACE-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/pace/themes/blue/pace-theme-flash.css') }}">
    <script type="text/javascript" src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Fonts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/themify-icons/themify-icons.css') }}">
    <!-- Primary Style-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/first-layout.css') }}">
    <!--WOW-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/wow/animate.css') }}">
    @yield('css')
</head>
<body style="background-image: url({{ URL::to('img/background_sign_v2.jpg') }})" class="body-bg-full v2">
    @yield('content')
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/sign.js') }}"></script>
    <script src="{{ asset('plugins/wow/wow.min.js') }}"></script>
</body>
</html>
