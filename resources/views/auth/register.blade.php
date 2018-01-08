@extends('layouts.master')
@section('title')
BruineVlootBemanning
@stop
@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<div class="container" id="register">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><small><a href="{{url('/')}}">Welkom</a></small></li>
    <li class="breadcrumb-item active" aria-current="page">Inschrijven</li>
  </ol>
  <div class="row">

    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Inschrijven</div>

        <div class="panel-body">
          @include('flash::message')
          <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">Voornaam</label>
              <div class="col-md-6">
                <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="" required="true">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">Achternaam</label>
              <div class="col-md-6">
                <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="" required="true">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">Geboortedatum</label>
              <div class="col-md-6">
                <input type="text" class="form-control datepicker" id="birthday" name="birthday" value="" placeholder="25-02-1983" required="true">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">Telefoon</label>
              <div class="col-md-6">
                <input type="phone" class="form-control" id="phone" name="phone" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">Woonplaats</label>
              <div class="col-md-6">
                <select class="select-places" id="selectPlace" name="city" required>
                </select>
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-mail adres</label>

              <div class="col-md-6">

                <input  v-model="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                <transition name="fading">
                  <small v-text="emailExists" class="text-danger"></small>
                </transition>
                @{{checkEmail}}

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
                <input  type="password" class="form-control" name="password" required>

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

new Vue({
  el:'#register',
  data:{
    email:'',
    result:'',
    emailExists:''
  },
  computed:{
    checkEmail: function(){
      var _this = this;
      axios.post('{{route("emailcheck")}}',{
        email: this.email
      }).then(response =>{
        this.result = response.data;
        if(this.result == true){
          _this.emailExists = 'Dit adres bestaat al';
        }else{
          _this.emailExists = '';
        }
      });
    }
  }
})
</script>
@stop
