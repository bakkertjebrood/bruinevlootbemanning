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
                <div class="panel-heading">Inschrijven</div>

                <div class="panel-body">
                  @include('flash::message')
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <!-- <div class="col-md-12 col-md-offset-5">
                          <img class="img img-circle img-lg" id="newad_image" src="{{url('uploads/photo')}}/default-photo.jpg" alt="">
                        </div>

                        <div class="form-group">
                          <label for="email" class="col-md-4 control-label">Afbeelding</label>
                          <div class="validation-errors"></div>
                          <div class="col-md-6">
                          <input id="newad_file" type="file" name="photo" class="form-control"/>
                        </div>
                        </div> -->

                        <div class="form-group">
                          <label for="email" class="col-md-4 control-label">Voornaam</label>
                          <div class="col-md-6">
                          <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="Voornaam" required="true">
                        </div>
                        </div>

                        <div class="form-group">
                          <label for="email" class="col-md-4 control-label">Achternaam</label>
                          <div class="col-md-6">
                          <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="Achternaam" required="true">
                        </div>
                        </div>

                        <div class="form-group">
                          <label for="email" class="col-md-4 control-label">Geboortedatum</label>
                          <div class="col-md-6">
                          <input type="text" class="form-control datepicker" id="birthday" name="birthday" value="" placeholder="01-03-1940" required="true">
                        </div>
                        </div>

                        <div class="form-group">
                          <label for="email" class="col-md-4 control-label">Telefoon</label>
                          <div class="col-md-6">
                          <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="Telefoon">
                        </div>
                        </div>

                        <div class="form-group">
                          <label for="email" class="col-md-4 control-label">Woonplaats</label>
                          <div class="col-md-6">
                          <select class="select-places" id="selectPlace" name="city">
                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-mail adres</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 control-label">Wachtwoord bevestigen</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Inschrijven
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#newad_image').attr('src', e.target.result);
      // $('#newad_image').style
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#newad_file").change(function() {
  readURL(this);
});

$("#newad_image").css( 'cursor', 'pointer' );
$("#newad_image").click(function() {
$("#newad_file").click();
});
</script>
@stop
