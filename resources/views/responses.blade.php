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
    @foreach($responses as $response)
    {{$response->name}}<br>
    @endforeach
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
