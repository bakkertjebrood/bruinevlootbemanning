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
    @include('inc.login_inline')
    @endif

  </div>

  <!-- Main ads grid -->
  <div class="col-lg-9">

    @include('flash::message')

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
              <h5><strong>{{str_limit($ad->name,25)}}</strong></h5>
              <small>{{str_limit($ad->description,75)}}</small>
            </div>

            <span class="ad_block_footer">
              <a type="button" class="btn btn-sm btn-default" href="{{url('/job',$ad->id)}}" name="button">Bekijken</a>
              <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ad_respond{{$ad->id}}" name="respond">Reageer</a>
            </span>
          </div>
        </div>

      </div>
      @include('inc.respond')
      @endforeach
    </div>

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
              <h5><strong>{{str_limit($ad->name,25)}}</strong></h5>
              <small>{{str_limit($ad->description,100)}}</small>
            </div>

            <span class="ad_block_footer">
              <a type="button" class="btn btn-sm btn-default" href="{{url('/job',$ad->id)}}" name="button">Bekijken</a>
              <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ad_respond{{$ad->id}}" name="respond">Reageer</a>
            </span>

          </div>
        </div>

      </div>
      @include('inc.respond')
      @endforeach
    </div>


  </div>
  <!-- col3  -->

</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
