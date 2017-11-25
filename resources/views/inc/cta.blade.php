
<div class="container-fluid call-to-action">
  <div class="container">
    <div class="pull-right">




        <div class="dropdown user-link">
          @if (Auth::guest())
            <a href="/login" class="btn btn-default btn-login" name="button">Inloggen</a>
            @else
              <a class="user-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Welkom, {{Auth::user()->name}}
                <span class="caret"></span>
              </a>
            @endif
          <ul class="dropdown-menu" role="menu" aria-labelledby="">
            <li><a href="/user/profile/">Mijn profiel</a></li>
            <li><a href="#">Mijn instellingen</a></li>
            <li><a href="{{route('logout')}}">Uitloggen</a></li>
          </ul>
        </div>

    </div>
  </div>
</div>
