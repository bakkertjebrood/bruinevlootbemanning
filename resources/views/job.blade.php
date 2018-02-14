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
  <span>
  <a href="
     @if($ad->type == 1)
     {{route('jobopenings')}}
     @else
     {{route('jobrequests')}}
     @endif" class="h4 clean"><span class="fa fa-arrow-circle-left"></span>
     @if($ad->type == 1)
     @lang('labels.openingsall')
     @else
     @lang('labels.requestsall')
     @endif
   </a>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><small><a href="{{route('home')}}">@lang('labels.welcome')</a></small></li>
    <li class="breadcrumb-item"><small><a href="
       @if($ad->type == 1)
       {{route('jobopenings')}}
       @else
       {{route('jobrequests')}}
       @endif">
       @if($ad->type == 1)
       @lang('labels.openingsall')
       @else
       @lang('labels.requestsall')
       @endif
     </a></small></li>
     <li class="breadcrumb-item active" aria-current="page">{{str_limit($ad->name,45)}}</li>
   </ol>
</span>
  <div class="col-lg-8">

    @include('flash::message')
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ucfirst($ad->name)}}</h4>
      </div>
      <div class="panel-body">
        <p class="retainlinebreaks">{{$ad->description}}</p>
      </div>

    </div>
    <div class="list-group">
      @if($ad->type == 2)
      <div class="list-group-item">
        <h4>@lang('labels.experience')</h4>
        <p class="retainlinebreaks">{{$ad->experience}}</p>
      </div>
      @endif
      <div class="list-group-item">
        <h4>@lang('labels.harbor')</h4>
        <p id="selectPlace"></p>
      </div>

      <div class="list-group-item">
        <h4>@lang('labels.followingskills')</h4>
        <div>
          <span>
            @foreach($ad->skills as $skill)
            <span class="label label-default">{{strtolower($skill->skill_definition->name)}}</span>
            @endforeach
            @if($ad->skills->isEmpty())
            <i>@lang('labels.nodata')</i>
            @endif
          </span>
      </div>
    </div>
    <div class="list-group-item">
      <h4>@lang('labels.availablebetween')</h4>
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
    <strong>@lang('labels.placedby')</strong>  <p class="panel-title">{{$ad->user->firstname.' '.$ad->user->lastname}}</p>
    </div>
  </div>

  <div class="list-group">
    @if($ad->user->phonevisible == 1)
    <div class="list-group-item">
      <span class="glyphicon glyphicon-phone"> </span> {{$ad->user->phone}}
    </div>
    @endif
    @if($ad->user->emailvisible == 1)
    <div class="list-group-item">
    <span class="glyphicon glyphicon-envelope"> </span> <a href="mailto:{{$ad->user->email}}">{{$ad->user->email}}</a>
    </div>
    @endif
  </div>
  <div class="list-group">
    <div class="list-group-item">
      <strong>@lang('labels.watched'):</strong> {{$ad->views}}
    </div>
    <div class="list-group-item">
      <strong>@lang('labels.created'):</strong> {{date_format($ad->created_at,'d-m-Y')}}
    </div>
  </div>

  <div class="list-group notice-inverse">
    @if(Auth::user())
    @if($ad->user->id != Auth::user()->id && Auth::user())
    <a class="list-group-item list-group-item-primary" data-toggle="modal" data-target="#ad_respond{{$ad->id}}" href="#">@lang('labels.respond')</a>
    @else
    <a class="list-group-item list-group-item-primary" href="{{url('user/ad',$ad->id)}}">@lang('labels.update')</a>
    @endif
    @endif

    @if(Auth::guest())
    <a class="list-group-item list-group-item-primary" href="#" data-toggle="modal" data-target="#login_modal" class="">@lang('labels.respond')</a>
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
