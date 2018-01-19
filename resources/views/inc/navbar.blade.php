<div class="navmargin">

</div>
<nav class="navbar navbar-inverse navtop navbar-static-top">
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
      <div class="logo hidden-xs">


          <div class="logo-icon">
            <a href="{{route('home')}}"><h2 class=""> <strong>Bruine</strong>Vloot<small> bemanning</small><small>.nl</small></h2></a>
          </div>


      </div>
      <div class="logo-small">

        <a class="h3" href="{{route('home')}}"> <strong>Bruine</strong>Vloot<small> bemanning.nl</small></a>
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
        <li><a href="{{route('jobrequests')}}">Advertenties</a></li>
        <li><a href="{{route('faq')}}">Veelgestelde vragen</a></li>
        <li>
          @if (Auth::guest())
          <a href="#" data-toggle="modal" data-target="#login_modal" class="">Inloggen</a>
          @else
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Welkom, {{Auth::user()->firstname}}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{url('user/profile')}}">Mijn profiel</i></a></li>
            <li><a href="{{route('responses')}}">Mijn reacties</i></a></li>
            <li><a href="{{url('user/ad')}}">Mijn advertenties</i></a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{route('logout')}}">Uitloggen</a></li>
          </ul>
          @endif
        </li>
        <li>
          @if (Auth::guest())
          <a href="{{route('register')}}" class="">Inschrijven</a>
          @endif
        </li>
        <li><a href="{{route('contact')}}">Contact</a></li>
      </ul>
    </div>
  </div>

  <!-- <div class="employer-btn">
    <a type="button" class="btn btn-m btn-default btn-employer hidden-xs" name="button">Werkgever</a>
  </div> -->

</nav>
