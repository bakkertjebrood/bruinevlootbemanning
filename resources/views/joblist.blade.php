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
    <li class="breadcrumb-item"><small><a href="{{url('/')}}">Welkom</a></small></li>
    <li class="breadcrumb-item active" aria-current="page">Uw advertenties</li>
  </ol>

  @include('flash::message')

  <!-- Main ads grid -->
  <div class="col-lg-9">
    @if(!$jobopenings->isEmpty())
    <p class="h2">Uw <small>vacatures</small></p>
    <hr>
    @endif

    @foreach($jobopenings as $ad)

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="media">
          <div class="media-left">
            <a href="#">
              <img class="media-object ads-image-s " src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
            </a>
          </div>
          <div class="media-body">
            <div class="col-lg-8">
              <strong>{{$ad->name}}</strong><br>
              <p>{{str_limit($ad->description,100)}}</p>
            </div>
            <div class="col-lg-4 v-center">
              <div class="pull-right">

                  <form class="" action="{{url('user/ad',$ad->id)}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a type="button" class="btn btn-m btn-warning" href="{{url('user/ad',$ad->id)}}" name="button"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a type="button" class="btn btn-m btn-info" href="{{route('responses')}}" name="button"><span class="glyphicon glyphicon-comment"></span></a>
                    <button type="submit" class="btn btn-m btn-danger" name="delete"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>

              </div>
            </div>
          </div>
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
      <p class="h2">Uw <small>oproepen</small></p>
      <hr>
      @endif

    @foreach($jobrequests as $ad)
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="media">
          <div class="media-left">
            <a href="#">
              <img class="media-object ads-image-s " src="{{url('/uploads/photo')}}/{{$ad->photo}}" alt="Photo">
            </a>
          </div>
          <div class="media-body">
            <div class="col-lg-8">
              <strong>{{$ad->name}}</strong><br>
              <p>{{str_limit($ad->description,100)}}</p>
            </div>
            <div class="col-lg-4 v-center">
              <div class="pull-right">

                  <form class="" action="{{url('user/ad',$ad->id)}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a type="button" class="btn btn-m btn-warning" href="{{url('user/ad',$ad->id)}}" name="button"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a type="button" class="btn btn-m btn-info" href="{{route('responses')}}" name="button"><span class="glyphicon glyphicon-comment"></span></a>
                    <button type="submit" class="btn btn-m btn-danger" name="delete"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>

              </div>
            </div>
          </div>
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
