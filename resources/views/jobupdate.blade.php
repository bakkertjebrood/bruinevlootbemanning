@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<form  enctype="multipart/form-data" action="{{url('/user/ad',$ad->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><small><a href="{{url('/')}}">Welkom</a></small></li>
      <li class="breadcrumb-item"><small><a href="{{url('user/ad')}}">Jouw advertenties</a></small></li>
      @if($ad->type == 2)
      <li class="breadcrumb-item active" aria-current="page">Jouw oproep wijzigen</li>
      @else
      <li class="breadcrumb-item active" aria-current="page">Jouw vacature wijzigen</li>
      @endif

    </ol>

    <div class="page-header">
      @if($ad->type == 2)
      <h1>Jouw <small>oproep wijzigen</small></h1>
      @else
      <h1>Jouw <small>vacature wijzigen</small></h1>
      @endif

    </div>

    <div class="col-lg-9">

      @include('flash::message')

      <div class="form-group">
        <label for="name">Titel</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$ad->name}}" placeholder="Bijvoorbeeld: Matroos gezocht" required="true">
      </div>

      <div class="form-group">
        <label for="name">
          @if($ad->type == 2)
          Gewenste afvaarthaven
          @else
          Thuishaven
          @endif
        </label>
        <input type="text" class="form-control" id="homeport" name="homeport" value="{{$ad->homeport}}" placeholder="Enkhuizen" required="true">
      </div>

      <div class="form-group">
        @if($ad->type == 2)
        <label for="title">Vaardigheden & certificaten</label>
        @else
        <label for="title">Benodigde vaardigheden & certificaten</label>
        @endif

        <select multiple="true" class="select-skills" name="skills[]">
          @foreach($ad->skills as $skill)
          <option selected="selected" value="{{$skill->skill_definition_id}}">
            @foreach($skill_definitions as $skill_definition)
            @if($skill_definition->id == $skill->skill_definition_id)
            {{$skill_definition->name}}
            @endif
            @endforeach
          </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="title">Categorieën</label>
        <select multiple="true" class="select-categories" name="categories[]">
          @foreach($ad->categories as $category)
          <option selected="selected" value="{{$category->category_definition_id}}">
            @foreach($category_definitions as $category_definition)
            @if($category_definition->id == $category->category_definition_id)
            {{$category_definition->name}}
            @endif
            @endforeach
          </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        @if($ad->type == 2)
        <label for="daterange">Van wanneer tot wanneer ben je beschikbaar?</label>
        @else
        <label for="daterange">Van wanneer tot wanneer zoek je iemand?</label>
        @endif

        <div class="input-group input-daterange" id="daterange">
          <input type="text" class="form-control datepicker" name="startdate" value="{{date_format(new DateTime($ad->startdate),'d-m-Y')}}" placeholder="01-01-2018" required="true">
          <div class="input-group-addon">tot</div>
          <input type="text" class="form-control datepicker" name="enddate" value="{{date_format(new DateTime($ad->enddate),'d-m-Y')}}" placeholder="01-01-2019" required="true">
        </div>
      </div>

      <div class="form-group">
        <label for="name">Beschrijving</label>
        <textarea type="text" rows="7" class="form-control" name="description" value="" placeholder="Omschrijf wat u zoekt" required="true">{{ $ad->description }}</textarea>
      </div>

      @if($ad->type == 2)
      <div class="form-group">
        <label for="name">Ervaring</label>
        <textarea type="text" rows="7" class="form-control" name="experience" value="" placeholder="Omschrijf jouw relevante werkervaring" required="true">{{$ad->experience}}</textarea>
      </div>
      @endif

      <div class="pull-right">
        <button type="submit" class="btn btn-primary btn-l" name="button">Opslaan</button>
      </div>

    </div>

    <div class="col-lg-3">
      <img id="newad_image" class="img img-thumbnail" src="{{url('uploads/photo',$ad->photo)}}" alt="">
      <div class="form-group"><br>
        <label class="control-label" for="title">Afbeelding</label>
        <div class="validation-errors"></div>
        <input id="newad_file" type="file" name="photo" class="form-control" />
      </div>
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
</script>
@stop
