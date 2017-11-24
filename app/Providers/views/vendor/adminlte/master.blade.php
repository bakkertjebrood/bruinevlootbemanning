<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Pace -->
    <link rel="stylesheet" href="{{ asset('/css/pace.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ asset('/css/datepicker.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/custom.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    @endif

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
        <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.0/rg-1.0.2/datatables.min.css"/>
    @endif

    @yield('adminlte_css')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')
<script src="{{ asset('/js/pace.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" charset="utf-8"></script>
<script src="{{ asset('/js/bootstrap-datepicker.js') }}" charset="utf-8"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="{{ asset('/js/bootstrap-confirmation.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/custom.js') }}" charset="utf-8"></script>

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/r-2.2.0/rg-1.0.2/datatables.min.js"></script>
@endif

@yield('adminlte_js')
@yield('custom_scripts')

</body>
</html>
