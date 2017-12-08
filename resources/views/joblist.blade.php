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
    <li class="breadcrumb-item active" aria-current="page">Jouw advertenties</li>
  </ol>

  @include('flash::message')

  <!-- Main ads grid -->
  <div class="col-lg-9">
    <h2>Jouw <small>vacatures</small></h2>
    <hr>

    @foreach($ads as $ad)
    @if($ad->type == 1)

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
                    <a type="button" class="btn btn-m btn-warning" href="{{url('user/ad',$ad->id)}}" name="button">Wijzigen</a>
                    <button type="submit" class="btn btn-m btn-danger" name="delete">Verwijderen</button>
                  </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    @endif
    @endforeach


      <h2>Jouw <small>oproepen</small></h2>
      <hr>

    @foreach($ads as $ad)
    @if($ad->type == 2)
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
                    <a type="button" class="btn btn-m btn-warning" href="{{url('user/ad',$ad->id)}}" name="button">Wijzigen</a>
                    <button type="submit" class="btn btn-m btn-danger" name="delete">Verwijderen</button>
                  </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    @endif
    @endforeach


    <div class="pagination">
      {{$ads->links()}}
    </div>
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
