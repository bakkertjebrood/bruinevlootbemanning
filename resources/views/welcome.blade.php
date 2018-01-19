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

  <!-- Main ads grid -->
  <div class="col-lg-9">

    @include('flash::message')
    <div class="header">
      <a class="pull-right hidden-xs" href="{{route('jobopenings')}}"><small>Bekijk alle vacatures</small></a>
      <h2>Vacatures <small>een greep</small></h2>
    </div>

    <div class="row">
      @foreach($jobs as $ad)
      <div class="col-sm-6 col-md-4 col-lg-3">

        <div class="thumbnail">
          <a href="{{route('job',$ad->id)}}">
            <img class="img img-responsive" src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
          </a>
          <div class="caption clearfix">
            <div class="lineup">
              <h5><strong>{{str_limit($ad->name,35)}}</strong></h5>

            </div>

            <span class="ad_block_footer">
              <a type="button" class="btn btn-sm btn-default" href="{{url('/job',$ad->id)}}" name="button">Bekijken</a>
              @if(Auth::user())
              <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ad_respond{{$ad->id}}" name="respond">Reageer</a>
              @else
              <a type="button" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#login_modal" class="">Reageer</a>
              @endif
            </span>

          </div>
        </div>

      </div>
      @include('inc.respond')
      @endforeach
    </div>

    <div class="header">
      <a class="pull-right hidden-xs" href="{{route('jobrequests')}}"><small>Bekijk alle oproepen</small></a>
      <h2>Oproepen <small>een greep</small></h2>
    </div>

    <div class="row">
      @foreach($offers as $ad)
      <div class="col-sm-6 col-md-4 col-lg-3">

        <div class="thumbnail">
          <a href="{{route('job',$ad->id)}}">
            <img class="img img-responsive" src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
          </a>
          <div class="caption clearfix">
            <div class="lineup">
              <h5><strong>{{str_limit($ad->name,35)}}</strong></h5>

            </div>

            <span class="ad_block_footer">
              <a type="button" class="btn btn-sm btn-default" href="{{url('/job',$ad->id)}}" name="button">Bekijken</a>
              @if(Auth::user())
              <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ad_respond{{$ad->id}}" name="respond">Reageer</a>
              @else
              <a type="button" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#login_modal" class="">Reageer</a>
              @endif
            </span>
          </div>
        </div>

      </div>
      @include('inc.respond')
      @endforeach
    </div>


  </div>
  <!-- col3  -->
  <div class="col-lg-3">
    <div class="list-group notice-inverse profile-menu">
      <a href="{{route('jobrequest')}}" class="list-group-item">
        <span class="glyphicon glyphicon-bullhorn"></span>
        Plaats mijn oproep</a>
      <a href="{{route('jobopening')}}" class="list-group-item">
        <span class="glyphicon glyphicon-ok-circle"></span>
        Plaats een vacature</a>
    </div>


    <div class="list-group profile-menu">
      <label for="search">Ga naar</label>
      <a href="{{route('jobrequests')}}" class="list-group-item">
        <span class="glyphicon glyphicon-bullhorn"></span>
        Alle oproepen</a>
      <a href="{{route('jobopenings')}}" class="list-group-item">
        <span class="glyphicon glyphicon-ok-circle"></span>
        Alle vacatures</a>
    </div>

    @if(Auth::guest())
    @include('inc.login_inline')
    @endif

  </div>
</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
