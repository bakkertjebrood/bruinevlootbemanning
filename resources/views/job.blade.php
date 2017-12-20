@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><small><a href="{{route('home')}}">Welkom</a></small></li>
    <li class="breadcrumb-item"><small><a href="
      @if($ad->type == 1)
      {{route('jobopenings')}}
      @else
      {{route('jobrequests')}}
      @endif">
      @if($ad->type == 1)
      Vacatures overzicht
      @else
      Oproepen overzicht
      @endif
    </a></small></li>
    <li class="breadcrumb-item active" aria-current="page">{{$ad->name}}</li>
  </ol>

  <div class="col-lg-8">
    @include('flash::message')
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{$ad->name}}</h4>
      </div>
      <div class="panel-body">
        <p class="retainlinebreaks">{{$ad->description}}</p>
      </div>

    </div>
    <div class="list-group">
      @if($ad->type == 2)
      <div class="list-group-item">
        <h4>Ervaring</h4>
        <p class="retainlinebreaks">{{$ad->experience}}</p>
      </div>
      <div class="list-group-item">
        <h4>Leeftijd</h4> {{$age}}
      </div>
      @endif
      <div class="list-group-item">
        <h4>Thuishaven</h4>
        <p id="selectPlace"></p>
      </div>

      <div class="list-group-item">
        <h4>Bezit de volgende vaardigheden en/of certificaten</h4>
        <div>
          <span>
            @foreach($ad->skills as $skill)
            @foreach($skill_definitions as $skill_definition)
            @if($skill_definition->id == $skill->skill_definition_id)
            {{strToLower($skill_definition->name)}} |
            @endif
            @endforeach
            @endforeach
            @if($ad->skills->isEmpty())
            <i>Geen gegevens</i>
            @endif
          </span>
        </p>
      </div>
    </div>
    <div class="list-group-item">
      <h4>Beschikbaar tussen</h4>
      <p>{{date_format(new DateTime($ad->startdate),'d-m-Y')}} tot {{date_format(new DateTime($ad->enddate),'d-m-Y')}}</p>
    </div>
  </div>


</div>

<div class="col-lg-4">
  <div class="ad_photo">
    <img class="img img-thumbnail" src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="">
  </div><br>

  <div class="list-group">
    <div class="list-group-item">
    <strong>Geplaatst door:</strong>  <p class="panel-title">{{$ad->user->firstname.' '.$ad->user->lastname}}</p>
    </div>
    @if($ad->type == 1)
    <div class="list-group-item">
      <p>{{str_limit($ad->user->description,200)}}</p>
    </div>
      @endif
  </div>

  <div class="list-group">
    <div class="list-group-item">
      <strong>Aangemaakt:</strong> {{date_format($ad->created_at,'d-m-Y')}}
    </div>
    <div class="list-group-item">
      <strong>Laatst gewijzigd:</strong> {{date_format($ad->updated_at,'d-m-Y')}}
    </div>
  </div>

  <div class="list-group notice-inverse">
    @if(Auth::user())
    <a class="list-group-item list-group-item-primary" data-toggle="modal" data-target="#ad_respond{{$ad->id}}" href="#">Reageren</a>
    @elseif($ad->user->id == Auth::user()->id)
    <a class="list-group-item list-group-item-primary" href="{{url('user/ad',$ad->id)}}">Wijzigen</a>

    @endif

  </div>

@include('inc.respond')
</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
var place_id = {{$ad->homeport}};
var type = 'p';
selectPlace(type);
</script>
@stop
