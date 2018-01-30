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
    <li class="breadcrumb-item"><small><a href="{{url('/')}}">@lang('labels.welcome')</a></small></li>
    <li class="breadcrumb-item active" aria-current="page">@lang('labels.register')</li>
  </ol>
  <div class="row">

    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">@lang('labels.register')</div>

        <div class="panel-body">
          @include('flash::message')
          <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <br>
            <div class="social-wrap">
              @include('inc.social')
            </div>


            <div class="form-group">
              <label for="email" class="col-md-4 control-label">@lang('labels.firstname')</label>
              <div class="col-md-6">
                <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="" required="true">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">@lang('labels.lastname')</label>
              <div class="col-md-6">
                <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="" required="true">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">@lang('labels.city')</label>
              <div class="col-md-6">
                <select class="select-places" id="selectPlace" name="city" required>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-4 control-label">@lang('labels.phone') <small class="text-muted"></small></label>
              <div class="col-md-6">
                <input type="phone" minlength="10" maxlength="15" class="form-control" id="phone" name="phone" value="" placeholder="0622065216">
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">@lang('labels.email')</label>

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
              <label for="password" class="col-md-4 control-label">@lang('labels.password')</label>

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
              <label for="password-confirm" class="col-md-4 control-label">@lang('labels.confirmpassword')</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <div class="checkbox checkbox-default">
                  <input type="checkbox" checked name="phonevisible" id="phonevisible" value="1">
                  <label for="phonevisible" class="">@lang('labels.showphone')</label>
                </div>
                <div class="checkbox checkbox-default">
                  <input  type="checkbox" checked name="emailvisible" id="emailvisible" value="1">
                  <label for="emailvisible" >@lang('labels.showemail')</label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <div class="radio radio-inline">
                  <input type="radio" name="role_id" id="radio1" value="1" checked="">
                  <label for="radio1">
                    @lang('labels.searchwork')
                  </label>
                </div>
                <div class="radio radio-inline">
                  <input type="radio" name="role_id" id="radio2" value="2" checked="">
                  <label for="radio2">
                    @lang('labels.offerwork')
                  </label>
                </div>
                <div class="radio radio-inline">
                  <input type="radio" name="role_id" id="radio3" value="3" checked="">
                  <label for="radio3">
                    @lang('labels.bothoptions')
                  </label>
                </div>
              </div>
            </div><br>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button :disabled="disabled == 1" type="submit" class="btn btn-primary btn-xl">
                  @lang('labels.registerandactivate')
                </button>

              </div>

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
new Vue({
  el:'#register',
  data:{
    email:'',
    result:'',
    emailExists:'',
    disabled: ''
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
          _this.disabled = 1;
        }else{
          _this.emailExists = '';
          _this.disabled = 0;
        }
      });
    }
  }
});
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#newad_image').attr('src', e.target.result);
      $('#newad_image').addClass('ad-image-m');
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

$(function(){
  $('#phone').bind('input', function(){
    $(this).val(function(_, v){
      return v.replace(/\s+/g, '');
    });
  });
});


</script>
@stop
