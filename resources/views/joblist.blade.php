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
    <li class="breadcrumb-item"><small><a href="{{url('/')}}">@lang('labels.welcome')</a></small></li>
    <li class="breadcrumb-item active" aria-current="page">@lang('labels.myads')</li>
  </ol>

  @include('flash::message')

  <!-- Main ads grid -->
  <div class="col-lg-9">
    @if(!$jobopenings->isEmpty())
    <p class="h2">@lang('labels.my') <small>@lang('labels.openings')</small></p>
    <hr>
    @endif

    @foreach($jobopenings as $ad)

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="media">
          <div class="media-left">
            <a href="{{url('user/ad',$ad->id)}}">
              <img class="media-object ads-image-s hidden-xs" src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
            </a>
          </div>
          <div class="media-body">
            <div class="col-lg-12">
              <a href="{{url('user/ad',$ad->id)}}"><strong>{{$ad->name}}</strong></a><br>
              <p>{{str_limit($ad->description,300)}}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer clearfix">
        <div class="pull-right">
          <form class="" action="{{url('user/ad',$ad->id)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a type="button" class="btn btn-sm btn-default" href="{{url('user/ad',$ad->id)}}" name="button"><span class="glyphicon glyphicon-pencil"></span> @lang('labels.update')</a>
            <button type="submit" class="btn btn-sm btn-danger" data-toggle="confirmation" name="delete"><span class="glyphicon glyphicon-trash"></span> @lang('labels.delete')</button>
          </form>
        </div>
      </div>
    </div>

    @endforeach
    @if(!$jobopenings->isEmpty())
    <div class="pagination">
      {{$jobopenings->links()}}
    </div>
    @endif


    @if(!$jobrequests->isEmpty())
    <p class="h2">@lang('labels.my') <small>@lang('labels.requests')</small></p>
    <hr>
    @endif

    @foreach($jobrequests as $ad)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="media">
          <div class="media-left">
            <a href="{{url('user/ad',$ad->id)}}">
              <img class="media-object ads-image-s hidden-xs" src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
            </a>
          </div>
          <div class="media-body">
            <div class="col-lg-12">
              <a href="{{url('user/ad',$ad->id)}}"><strong>{{$ad->name}}</strong></a><br>
              <p>{{str_limit($ad->description,300)}}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer clearfix">
        <div class="pull-right">
          <form class="" action="{{url('user/ad',$ad->id)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a type="button" class="btn btn-sm btn-default" href="{{url('user/ad',$ad->id)}}" name="button"><span class="glyphicon glyphicon-pencil"></span> @lang('labels.update')</a>
            <button type="submit" class="btn btn-sm btn-danger" data-toggle="confirmation" name="delete"><span class="glyphicon glyphicon-trash"></span> @lang('labels.delete')</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach

    @if(!$jobrequests->isEmpty())
    <div class="pagination">
      {{$jobrequests->links()}}
    </div>
    @endif
  </div>

  <div class="col-lg-3">
    @include('inc.usermenu')
  </div>

</div>


@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
