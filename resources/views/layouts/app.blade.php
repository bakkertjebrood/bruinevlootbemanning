<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <link rel="stylesheet" href="/css/custom.css">
  <link rel="stylesheet" href="/css/bootstrap-datepicker3.standalone.min.css">
  @yield('header')

</head>
<body>
    <nav class="navbar navbar-inverse navtop">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <div class="logo">
          <a class="" href="#">
            <img class="logo-img" alt="Brand" src="/images/logo.png">
          </a>
        </div>
      </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            &nbsp;
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right top-menu">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('responses')}}">Advertenties</a></li>
          <li><a href="{{route('faq')}}">Hoe het werkt</a></li>
          <li><a href="{{route('contact')}}">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

<footer></footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.nl.min.js" charset="utf-8"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="/js/custom.js" charset="utf-8"></script>
@yield('scripts')
</body>
</html>
