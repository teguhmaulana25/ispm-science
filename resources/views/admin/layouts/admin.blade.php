<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>

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
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/PACE/themes/blue/pace-theme-flash.css') }}">
    <script type="text/javascript" src="{{ asset('plugins/PACE/pace.min.js') }}"></script>
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Fonts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/themify-icons/themify-icons.css') }}">
    <!-- Font Awesome 5.11.2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome/css/all.min.css') }}">
    <!-- Malihu Scrollbar-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}">
    <!-- Animo.js-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/animo.js/animate-animo.min.css') }}">
    <!-- Bootstrap Progressbar-->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}">
    <!-- Custom Page Style-->
    @stack('css')
    <!-- Primary Style-->
    <link rel="stylesheet" type="text/css" href="{{ asset('build/css/first-layout.css') }}">
    <!-- Custom Style-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app_master.css') }}">
    <!-- Javascript Head -->
    @stack('js_head')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body data-sidebar-color="sidebar-light" class="sidebar-light">
    <!-- Header start-->
    @include('admin.includes.header')
    <!-- Header end-->
    <div class="main-container">
      <!-- Main Sidebar start-->
      @include('admin.includes.sidebar')
      <!-- Main Sidebar end-->
      <div class="page-container">
        <div class="page-header container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <!-- Add Button in Header -->
              <h4 class="mt-0 mb-5">@yield('title') @yield('add')</h4>
              <ol class="breadcrumb mb-0">
                @yield('breadcrumb')
              </ol>
            </div>
          </div>
        </div>
        <!-- AREA NOTIF -->
        <div class="page-content container-fluid">
          <div class="row">
            @include('admin.common.error')
            @include('admin.common.success')
            @yield('content')
          </div>
        </div>
        @include('admin.includes.footer')
      </div>
      {{-- @include('includes.right-sidebar') --}}
    </div>
    <div class="page-ajax">
      <div class="page-loader">
        <div class="spinner">
          <i class="fas fa-spinner fa-spin"></i>
        </div>
        {{-- <div class="sk-three-bounce">
          <div class="sk-child sk-bounce1"></div>
          <div class="sk-child sk-bounce2"></div>
          <div class="sk-child sk-bounce3"></div>
        </div> --}}
        Please wait...
      </div>
    </div>
		<!-- jQuery 2.2.3 -->
		<script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
    <!-- Bootstrap -->
		<script type="text/javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Malihu Scrollbar-->
    <script type="text/javascript" src="{{ asset('plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Animo.js-->
    <script type="text/javascript" src="{{ asset('plugins/animo.js/animo.min.js') }}"></script>
    <!-- Bootstrap Progressbar-->
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- jQuery Easy Pie Chart-->
    <script type="text/javascript" src="{{ asset('plugins/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
    <!-- Umega JS-->
    <script type="text/javascript" src="{{ asset('build/js/first-layout/app.js') }}"></script>
    <!-- Application custom script -->
    @stack('scripts')
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
  </body>
</html>
