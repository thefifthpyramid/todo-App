<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>Laravel</title>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('../Design/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('../Design/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('../Design/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('../Design/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('../Design/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('../css/app.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('../Design/dist/css/adminlte.min.css')}}">
    @vite(['resources/js/app.js','resources/css/app.css'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">


<div class="wrapper" id="app"></div>



<!-- jQuery -->
<script src="{{asset('Design/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('Design/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('Design/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
{{-- data Table --}}
<script src="{{asset('Design/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Design/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('Design/dist/js/demo.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('../Design/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('../Design/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('../Design/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('../Design/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('../Design/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('Design/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

<script src="{{asset('Design/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('Design/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('Design/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
