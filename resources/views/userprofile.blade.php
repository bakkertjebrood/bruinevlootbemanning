@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<form  enctype="multipart/form-data" action="{{url('/user/profile')}}/{{$user->id}}" method="post">
<div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><small><a href="{{url('/')}}">@lang('labels.welcome')</a></small></li>
    <li class="breadcrumb-item active" aria-current="page">Profiel {{$user->firstname.' '.$user->lastname}}</li>
  </ol>

  <div class="col-lg-9">

    <div>
      <h1>@lang('labels.profile')</h1>
      <hr>
    </div>

  @include('flash::message')

    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
      <label class="control-label" for="title">@lang('labels.photo')</label>
      <div class="validation-errors"></div>
      <input id="newad_file" type="file" name="photo" class="form-control"/>
    </div>

    <div class="form-group">
      <label for="firstname">@lang('labels.firstname')</label>
      <input type="text" class="form-control" id="firstname" name="firstname" value="{{$user->firstname}}" placeholder="@lang('labels.firstname')" required="true">
    </div>

    <div class="form-group">
      <label for="lastname">@lang('labels.lastname')</label>
      <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user->lastname}}" placeholder="@lang('labels.lastname')" required="true">
    </div>

    <div class="form-group">
      <label for="email">@lang('labels.email')</label>
      <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="@lang('labels.email')" required="true">
    </div>

    <!-- <div class="form-group">
      <label for="city">@lang('labels.city')</label>
      <select class="select-places" id="selectPlace" name="city">

      </select>
    </div> -->

    <div class="form-group">
      <label for="phone">@lang('labels.phone')</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" placeholder="@lang('labels.phone')">
    </div>
    <div class="form-group">
      <div>
        @if($user->phonevisible == 1)
      <input class="form-check-input" type="checkbox" checked name="phonevisible" id="phonevisible" value="1">
        @else
        <input class="form-check-input" type="checkbox"  name="phonevisible" id="phonevisible" value="1">
        @endif
      <label for="phonevisible" class="control-label">@lang('labels.showphone')</label>
    </div>
    </div>

    <div class="form-group">
        <div>
          @if($user->emailvisible == 1)
      <input class="form-check-input" type="checkbox" checked name="emailvisible" id="emailvisible" value="1">
        @else
        <input class="form-check-input" type="checkbox" name="emailvisible" id="emailvisible" value="1">
        @endif
      <label for="emailvisible" class="control-label">@lang('labels.showemail')</label>
    </div>
    </div>


    <div class="form-footer pull-right">
      <button type="submit" class="btn btn-primary btn-l" name="button">@lang('labels.save')</button>
    </div>


    <input type="hidden" id="option" name="option" value="">

  </div>


  <div class="col-lg-3">
    <div class="profile">
      <img class="img img-thumbnail" id="newad_image" src="{{url('uploads/photo',$user->photo)}}" alt="">
    </div><br>
    @include('inc.usermenu')
  </div>

</div>
</form>
@stop

@section('scripts')
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#newad_image').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#newad_file").change(function() {
  readURL(this);
});

$('#jobopening').click(function(){
  $('#option').val('1');
});

$('#jobrequest').click(function(){
  $('#option').val('2');
});

$("#newad_image").css( 'cursor', 'pointer' );
$("#newad_image").click(function() {
$("#newad_file").click();
});

var place_id = {{$user->city}};
var type = 'select';
selectPlace(type);
</script>
@stop
