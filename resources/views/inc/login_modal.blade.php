
      <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Inloggen</h4>
            </div>
            <div class="modal-body">

                  {{ csrf_field() }}

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="col-md-4 control-label">E-mail adres</label>

                      <div class="col-md-6">
                          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-4 control-label">Wachtwoord</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control" name="password" required>

                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <div class="checkbox">
                              <label>
                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Mij onthouden
                              </label>
                          </div>
                      </div>
                  </div>

            </div>
            <div class="modal-footer">

              <a class="btn btn-link" href="{{ route('password.request') }}">
                  Wachtwoord vergeten
              </a> |
              <a class="btn btn-link" href="{{ route('register') }}">
                  Inschrijven
              </a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
              <button type="submit" class="btn btn-primary">Inloggen</button>
            </div>
            </form>
          </div>
        </div>
      </div>
