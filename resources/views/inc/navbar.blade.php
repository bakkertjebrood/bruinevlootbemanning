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
      <div class="logo hidden-xs hidden-sm">


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
        <li><a href="{{route('home')}}">@lang('labels.home')</a></li>
        <li><a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">@lang('labels.ads')
          <span class="caret"></span>
        </a>
          <ul class="dropdown-menu">
            <li><a href="{{route('jobrequests')}}">@lang('labels.ads')</i></a></li>
            <li><a href="{{route('jobrequest')}}">@lang('labels.newrequest')</i></a></li>
            <li><a href="{{route('jobopening')}}">@lang('labels.newopening')</i></a></li>
          </ul>
        </li>
        <li><a href="{{route('faq')}}">@lang('labels.faq')</a></li>
        <li>
          @if (Auth::guest())
          <a href="#" data-toggle="modal" data-target="#login_modal" class="">@lang('labels.login')</a>
          @else
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('labels.welcome'), {{Auth::user()->firstname}}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{url('user/profile')}}">@lang('labels.myprofile')</i></a></li>
            <li><a href="{{route('responses')}}">@lang('labels.myresponses')</i></a></li>
            <li><a href="{{url('user/ad')}}">@lang('labels.myads')</i></a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{route('logout')}}">@lang('labels.logout')</a></li>
          </ul>
          @endif
        </li>
        <li>
          @if (Auth::guest())
          <a href="{{route('register')}}" class="">@lang('labels.register')</a>
          @endif
        </li>
        <li><a href="{{route('contact')}}">@lang('labels.contact')</a></li>
      </ul>
    </div>
  </div>

</nav>
