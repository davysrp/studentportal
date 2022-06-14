<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset("assets/admin/dist/css/adminlte.min.css")!!}" >
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
@yield('content')

<!-- jQuery -->
<script src="{!! asset('assets/admin/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>
</body>
</html>
