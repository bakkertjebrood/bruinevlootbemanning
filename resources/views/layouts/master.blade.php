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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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

    <div class="employer-btn">
      <a type="button" class="btn btn-m btn-default btn-employer" name="button">Werkgever</a>
    </div>

  </nav>

  <div class="container-fluid main_image">
    <div class="container">
      <div class="phrase pull-right">
        <h1>Schippers, matrozen, horeca personeel en klussers gevraagd</h1>
        <p>Van student tot pensionado, van starter tot ervaren bemanningslid, iedereen is welkom! Er is werk te doen aan boord van prachtige historische schepen binnen of buiten het vaar seizoen. Schrijf je dus in of ben je scheepseigenaar, plaats jouw vacature en kom in contact met mede enthousiastelingen.</p>
      </div>
    </div>
  </div>
  <div class="container-fluid call-to-action">
    <div class="container">
      <div class="pull-right">

          <div class="dropdown call-to-action-dropdown">
            @if (Auth::guest())
              <a href="/login" class="btn btn-default btn-login" name="button">Inloggen</a>
              @else
                <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Welkom, {{Auth::user()->name}}
                  <span class="caret"></span>
                </a>
              @endif
            <ul class="dropdown-menu" role="menu" aria-labelledby="">
              <li><a href="/employee/profile/{{Isset(Auth::user()->id)}}">Mijn profiel</a></li>
              <li><a href="#">Mijn instellingen</a></li>
              <li><a href="#">Uitloggen</a></li>
            </ul>
          </div>


      </div>
    </div>
  </div>

  @yield('content')


<div class="container-fluid footer-wrapper">

    <div class="container">
    <footer class="footer-bs">

      <div class="divider">
      </div>
        <div class="row">
        	<div class="col-md-3 footer-brand animated fadeInLeft">
            	<h2>Logo</h2>
                <p>Suspendisse hendrerit tellus laoreet luctus pharetra. Aliquam porttitor vitae orci nec ultricies. Curabitur vehicula, libero eget faucibus faucibus, purus erat eleifend enim, porta pellentesque ex mi ut sem.</p>
                <p>© 2014 BS3 UI Kit, All rights reserved</p>
            </div>
        	<div class="col-md-4 footer-nav animated fadeInUp">
            	<h4>Menu —</h4>
            	<div class="col-md-6">
                    <ul class="pages">
                        <li><a href="#">Travel</a></li>
                        <li><a href="#">Nature</a></li>
                        <li><a href="#">Explores</a></li>
                        <li><a href="#">Science</a></li>
                        <li><a href="#">Advice</a></li>
                    </ul>
                </div>
            	<div class="col-md-6">
                    <ul class="list">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">Terms & Condition</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        	<div class="col-md-2 footer-social animated fadeInDown">
            	<h4>Follow Us</h4>
            	<ul>
                	<li><a href="#">Facebook</a></li>
                	<li><a href="#">Twitter</a></li>
                	<li><a href="#">Instagram</a></li>
                	<li><a href="#">RSS</a></li>
                </ul>
            </div>
        	<div class="col-md-3 footer-ns animated fadeInRight">
            	<h4>Newsletter</h4>
                <p>A rover wearing a fuzzy suit doesn’t alarm the real penguins</p>
                <p>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
                      </span>
                    </div><!-- /input-group -->
                 </p>
            </div>
        </div>
    </footer>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.nl.min.js" charset="utf-8"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="/js/custom.js" charset="utf-8"></script>
@yield('scripts')
</body>
</html>
