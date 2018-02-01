@extends('layouts.master')

@section('title')
BruineVlootBemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.poster')
@include('inc.cta')
@stop
@section('content')
<div class="container">
  <!-- col3  -->
  <div class="col-lg-3">
    @include('inc.newads')


    <div class="list-group notice profile-menu">
      <!-- <label for="search">Ga naar</label>-->
      <h4>@lang('labels.goto')</h4>
      <a href="{{route('jobrequests')}}" class="list-group-item">
        <span class="fa fa-folder-open"></span>
        @lang('labels.allads')</a>
    </div>

    @if(Auth::guest())
    @include('inc.login_inline')
    @endif
<div class="hidden-xs">

<h4>@lang('labels.newmembers')</h4>
    <ul class="list-group">
      @foreach($new_users as $new_user)
      <li class="list-group-item"><img src="{{url('uploads/photo',$new_user->photo)}}" class="img img-circle ads-image-xs" alt="">{{ucfirst($new_user->firstname)}} - <small class="text-muted">{{date_format($new_user->created_at,'d-M')}}</small></li>
      @endforeach
    </ul>
    </div>

  </div>

  <!-- Main ads grid -->
  <div class="col-lg-9">

    @include('flash::message')

    <div class="header">
      <a class="pull-right hidden-xs" href="{{route('jobopenings')}}"><small>@lang('labels.showallads')</small></a>
      <h2>@lang('labels.openingsc') <small>@lang('labels.aselection')</small></h2>
    </div>

    <div class="row">
      @foreach($jobs as $ad)
      <div class="col-sm-2 col-md-4 col-lg-3">
        <a href="{{route('job',$ad->id)}}" class="clean ">
          <div class="thumbnail shadowhover">
            <img class="img img-responsive" src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
            <div class="caption clearfix">
              <div class="lineup">
                  <strong class="h5 ">{{str_limit(ucfirst($ad->name),18)}}</strong>
              </div>
            </div>
          </div>
        </a>

      </div>
      @endforeach
    </div>

    <div class="header">
      <a class="pull-right hidden-xs" href="{{route('jobrequests')}}"><small>@lang('labels.showallads')</small></a>
      <h2>@lang('labels.requestsc') <small>@lang('labels.aselection')</small></h2>
    </div>

    <div class="row">
      @foreach($offers as $ad)
      <div class="col-sm-6 col-md-4 col-lg-3">

        <a href="{{route('job',$ad->id)}}" class="clean ">
          <div class="thumbnail shadowhover">
            <img class="img img-responsive" src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
            <div class="caption clearfix">
              <div class="lineup">
                  <strong class="h5">{{str_limit(ucfirst($ad->name),18)}}</strong>
              </div>
            </div>
          </div>
        </a>


      </div>
      @endforeach
    </div>


  </div>

</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
