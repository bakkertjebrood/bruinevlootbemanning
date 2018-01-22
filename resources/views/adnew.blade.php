@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<form  enctype="multipart/form-data" action="{{url('user/ad')}}" method="post">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><small><a href="{{url('/')}}">Welkom</a></small></li>
      <li class="breadcrumb-item active" aria-current="page">
        @if($ad_type == 1)
        Vacature aanmaken
        @else
        Oproep aanmaken
        @endif
      </li>
    </ol>

    <div>
      @if($ad_type == 1)
      <h1>Nieuwe vacature plaatsen</h1>
      @else
      <h1>Nieuwe oproep plaatsen</h1>
      @endif
      <hr>
    </div>

    <div class="col-lg-9">

      @include('flash::message')

      {{ csrf_field() }}
      <input type="hidden" name="type" value="{{$ad_type}}">
      <div class="form-group">
        @if($ad_type == 1)
        <label for="name">Vacature titel</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Matroos gezocht" required="true">
        @else
        <label for="name">Oproep omschrijving</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Matroos aangeboden" required="true">
        @endif
      </div>

      <div class="form-group">
        <label class="control-label" for="title">Afbeelding</label>
        <div class="validation-errors"></div>
        <input id="newad_file" type="file" name="photo" class="form-control"/>
      </div>

      <div class="form-group">
        <label for="name">
          @if($ad_type == 1)
          Thuishaven
          @else
          Voorkeur vertrekhaven
          @endif
        </label>
        <!-- <input type="text" class="form-control" id="homeport" name="homeport" value="" placeholder="Enkhuizen" required="true"> -->
        <select class="select-places" id="selectPlace" name="homeport" required="true">

        </select>
      </div>

      <div class="form-group">
        <label for="title">
          @if($ad_type == 1)
          Benodigde vaardigheden, certificaten of diploma's
          @else
          Ik beschik over de volgende vaardigheden, certificaten of diploma's
          @endif
        </label>
        <select multiple="true" class="select-skills" name="skills[]">
        </select>
      </div>

      <div class="form-group">
        <label for="title">Categorieën</label>
        <select multiple="true" class="select-categories" name="categories[]" required="true">
        </select>
      </div>

      <div class="form-group">
        <label for="daterange">
          @if($ad_type == 1)
          Van wanneer tot wanneer zoekt u iemand?
          @else
          Van wanneer tot wanneer bent u beschikbaar?
          @endif
        </label>
        <div class="input-group input-daterange" id="daterange">
          <input type="text" class="form-control datepicker" name="startdate" value="" placeholder="01-01-2018" required="true">
          <div class="input-group-addon">tot</div>
          <input type="text" class="form-control datepicker" name="enddate" value="" placeholder="01-01-2019" required="true">
        </div>
      </div>

      <div class="form-group">
        @if($ad_type == 1)
        <label for="name">Beschrijving</label>
        <textarea type="text" rows="7" class="form-control" name="description" value="" placeholder="Omschrijf wat u zoekt" required="true"></textarea>
        @else
        <label for="name">Beschrijving</label>
        <textarea type="text" rows="7" class="form-control" name="description" value="" placeholder="Beschrijf uzelf & uw motivatie" required="true"></textarea>
        @endif
      </div>

      @if($ad_type == 2)
      <div class="form-group">
        <label for="name">Ervaring</label>
        <textarea type="text" rows="7" class="form-control" name="experience" value="" placeholder="Welke ervaring heeft u?" required="true"></textarea>
      </div>
      @endif

      <div class="pull-right">
        <button type="submit" class="btn btn-primary btn-l" name="button">Opslaan</button>
      </div>

    </div>

    <div class="col-lg-3">
      @if($ad_type == 1)
      <img id="newad_image" class="img img-thumbnail" src="{{url('/uploads/photo','default-photo.jpg')}}" alt="">
      @else
      <img id="newad_image" class="img img-thumbnail" src="{{url('/uploads/photo',Auth::user()->photo)}}" alt="">
      @endif
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

$("#newad_image").css( 'cursor', 'pointer' );
$("#newad_image").click(function() {
$("#newad_file").click();
});

$("#newad_file").change(function() {
  readURL(this);
});

</script>
@stop
