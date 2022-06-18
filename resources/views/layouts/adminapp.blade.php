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
    <link rel="stylesheet" href="{!! asset("assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")!!}">
    <link rel="stylesheet" href="{!! asset("assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")!!}">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{!! asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
@include('layouts.Nav')
@include('layouts.Mainbar')
@include('layouts.Content')




<!-- jQuery -->
<script src="{!! asset('https://code.jquery.com/jquery-3.5.1.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>

<!-- DataTables -->
<script src="{!! asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>


<!-- jquery-validation -->
<script src="{!! asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/jquery-validation/additional-methods.min.js') !!}"></script>
<script src="{!! asset('js/jquery.form.js') !!}"></script>
@yield('validation')
@yield('datatable')

<script>
    $(document).ready(function (){
        if ($(".nav-item .nav .nav-item .nav-link").hasClass("active")){
           $(this).closest('.nav-item ').addClass('menu-open')
           $(this).closest('.nav-item .nav-link').addClass('menu-open')
        }
    })
</script>
</body>
</html>
