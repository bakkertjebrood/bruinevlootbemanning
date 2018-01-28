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
    <li class="breadcrumb-item active" aria-current="page">Veelgestelde vragen</li>
  </ol>

  <div class="panel-group" id="accordion">

    <div class="faqHeader">Veelgestelde vragen</div>
    @foreach($faqs as $faq)
    <div class="panel panel-default">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#{{$faq->id}}">
      <div class="panel-heading">
        <h4 class="panel-title">
          <strong>

            {{$faq->name}}
          </strong>
          </h4>
        </div>
        </a>
        <div id="{{$faq->id}}" class="panel-collapse collapse">
          <div class="panel-body">
        {!!$faq->description!!}
          </div>
        </div>
      </div>
      @endforeach

      <!-- stoppo -->

    </div>
  </div>


  @stop

  @section('scripts')
  <script type="text/javascript">

  </script>
  @stop
