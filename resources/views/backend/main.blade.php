<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$apk_name}}</title>
    <link rel="apple-touch-icon" href="{{ asset('templates/backend/app-assets/images/ico/favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/backend/setting/pict/'.$pict) }}">

    @include('templates._header_admin')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      {{-- Users --}}
      @include('backend.partials.nav_icon._user')

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      {{-- Sidebar Menu --}}
      @include('backend.partials.sidebar._side_menu')

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
        <!-- /.content -->
      </div><!-- /.content-wrapper -->

      @include('backend.partials._footer')

      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    @include('templates._footer_admin')
    @notify_render
  </body>
<!-- END: Body-->

</html>
