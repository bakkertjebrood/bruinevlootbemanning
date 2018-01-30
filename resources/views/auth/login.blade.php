@extends('layouts.master')
@section('title')
BruineVlootBemanning
@stop
@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')

<div class="container">
  <div class="row">
    <div class="login hidden-xs">

    </div>
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">@lang('labels.logintoproceed')</div>

        <div class="panel-body">
          <br>
          <div class="social-wrap">
            @include('inc.social')
          </div>

          @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
          @endif
          @include('flash::message')


          @if ($message = Session::get('warning'))
          <div class="alert alert-warning">
            <p>{{ $message }}</p>
          </div>
          @endif
          <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">@lang('labels.email')</label>

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
              <label for="password" class="col-md-4 control-label">@lang('labels.password')</label>

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
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('labels.rememberme')
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  @lang('labels.login')
                </button>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                  @lang('labels.forgotpassword')
                </a> |
                <a class="btn btn-link" href="{{ route('register') }}">
                  @lang('labels.register')
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
