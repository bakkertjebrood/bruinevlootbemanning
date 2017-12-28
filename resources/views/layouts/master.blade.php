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
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="/css/bootstrap-datepicker3.standalone.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

</head>
<body>

  @yield('header')
  @yield('content')

  @include('inc.login_modal')

  <footer id="myFooter">
      <div class="container">
          <div class="row">
              <div class="col-sm-3">
                  <h5>Van start</h5>
                  <ul>
                      <li><a href="{{route('home')}}">Home</a></li>
                      <li><a href="{{route('register')}}">Inschrijven</a></li>
                      <li><a href="{{route('login')}}">Inloggen</a></li>
                  </ul>
              </div>
              <div class="col-sm-3">
                  <h5>Over ons</h5>
                  <ul>
                      <li><a href="{{route('about')}}">Het initiatief</a></li>
                      <li><a href="{{route('contact')}}">Neem contact op</a></li>
                      <li><a href="{{route('creator')}}">Wie is de maker</a></li>
                  </ul>
              </div>
              <div class="col-sm-3">
                  <h5>Ondersteuning</h5>
                  <ul>
                      <li><a href="{{route('faq')}}">Veelgestelde vragen</a></li>
                      <li><a href="{{route('contact')}}">Probleem melden</a></li>
                      <li><a href="{{route('suggestions')}}">Jouw suggestie indienen</a></li>
                  </ul>
              </div>
              <div class="col-sm-3 info">
                  <h5>Informatie</h5>
                  <p> Deze website is een gratis initiatief en brengt scheepseigenaren, bemanning, horeca personeel, klussers en andere enthousiaste mensen met elkaar in contact. </p>
              </div>
          </div>
      </div>
      <div class="second-bar">
         <div class="container">
              <h2 class="logo-footer"><a href="#"> <strong>Bruine</strong>Vloot<small> bemanning</small><small>.nl</small></a></h2>
              <div class="social-icons">
                  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                  <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
              </div>
          </div>
      </div>
  </footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.nl.min.js') }}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script src="{{ asset('js/places.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}" charset="utf-8"></script>

@yield('scripts')
</body>
</html>
