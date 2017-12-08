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
  <div class="col-lg-9">

    <div id="jobs">

      <div v-for="job in jobs" class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">@{{job.name}}</h3>
        </div>
        <div class="panel-body">
          <div class="media">
            <div class="media-left">
              <a href="">
                <img class="media-object ads-image-m" :src="'{{url('uploads/photo')}}/' + job.photo" alt="Photo">
              </a>
            </div>
            <div class="media-body">
              <div class="col-sm-6 col-md-4 col-lg-12">
                <p>@{{job.description | truncate(300) }}</p>
              </div>

              <div class="col-sm-3 col-md-6 col-lg-12">
                <strong>Periode: </strong><span>@{{job.startdate | moment("D-M-Y")}} tot @{{job.enddate | moment("D-M-Y")}} </span><br>
                <strong>Geplaatst op: </strong><span>@{{job.created_at | moment("D-M-Y")}} </span><br>

              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer clearfix">
          <span class="pull-right ">
            <a type="button" class="btn btn-m btn-default" href="" name="button">Meer informatie</a>
            <a type="button" class="btn btn-m btn-primary" href="" name="respond">Reageer</a>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3">

  </div>
</div>
@stop
