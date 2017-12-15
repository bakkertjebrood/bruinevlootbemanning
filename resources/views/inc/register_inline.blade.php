<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Inschrijven</h3>
  </div>
  <form class="form-horizontal" method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}
  <div class="panel-body">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="name" type="text" placeholder="Gebruikersnaam" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <input id="email" placeholder="E-mail" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="password" placeholder="Wachtwoord" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">

        <div class="col-md-12">
            <input id="password-confirm" placeholder="Herhaal wachtwoord" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>


  </div>

  <div class="panel-footer clearfix">
            <button type="submit" class="btn btn-primary pull-right">
                Inschrijven
            </button>
  </div>
  </form>
</div>
