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
      <a class="pull-right" href="{{route('jobrequests')}}"><small>Bekijk alle oproepen</small></a>
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
              <h5><strong>{{str_limit($ad->name,25)}}</strong></h5>
              <small>{{str_limit($ad->description,75)}}</small>
            </div>

            <span class="ad_block_footer">
              <a type="button" class="btn btn-sm btn-default" href="{{url('/job',$ad->id)}}" name="button">Bekijken</a>
              <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ad_respond" name="respond">Reageer</a>
            </span>
          </div>
        </div>

      </div>
      @endforeach
    </div>

    <div class="header">
      <a class="pull-right" href="{{route('jobopenings')}}"><small>Bekijk alle vacatures</small></a>
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
              <h5><strong>{{str_limit($ad->name,25)}}</strong></h5>
              <small>{{str_limit($ad->description,100)}}</small>
            </div>

            <span class="ad_block_footer">
              <a type="button" class="btn btn-sm btn-default" href="{{url('/job',$ad->id)}}" name="button">Bekijken</a>
              <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ad_respond" name="respond">Reageer</a>
            </span>

          </div>
        </div>

      </div>
      @include('inc.respond')
      @endforeach
    </div>


  </div>
  <div class="col-lg-3">
    <div class="list-group notice">
      <a href="{{route('jobrequest')}}" class="list-group-item">Plaats mijn oproep</a>
      <a href="{{route('jobopening')}}" class="list-group-item">Plaats een vacature</a>
    </div>


    <div class="list-group">
      <label for="search">Ga naar</label>
      <a href="{{route('jobrequests')}}" class="list-group-item">Alle oproepen</a>
      <a href="{{route('jobopenings')}}" class="list-group-item">Alle vacatures</a>
    </div>

    @if(Auth::guest())
    <div class="list-group">
      <label for="search">Direct doen</label>

      <a href="{{route('register')}}" class="list-group-item">Inschrijven</a>
      <a href="{{route('login')}}" class="list-group-item">Log hier in</a>


    </div>
    @else

    <div class="panel notice">
      <div class="panel-heading">
        <img class="img img-circle img-responsive img-sm" src="{{url('uploads/photo',Auth::user()->photo)}}" alt="">
        <h5 class="panel-title ">Welkom, {{Auth::user()->firstname}}</h5>
      </div>
      <div class="panel-body">

        <div class="list-group">
          <div><a class="list-group-item" href="{{url('user/profile')}}">Jouw profiel</a></div>
          <div><a class="list-group-item" href="#">Jouw advertenties</a></div>
        </div>

      </div>
    </div>

    @endif

  </div>
</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
