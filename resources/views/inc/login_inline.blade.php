<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">@lang('labels.login')</h3>
  </div>
  <form class="form-horizontal" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
  <div class="panel-body">
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <input id="" placeholder="E-mail" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <input id="" placeholder="Wachtwoord" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <div class="checkbox pull-right">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('labels.rememberme')
                </label>
            </div>
        </div>
    </div>
  </div>
  <div class="panel-footer clearfix">
    <button type="submit" class="btn btn-primary pull-right">
        @lang('labels.rememberme')
    </button>
  </div>
  </form>
</div>
