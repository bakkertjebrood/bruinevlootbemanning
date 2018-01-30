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
    <li class="breadcrumb-item active" aria-current="page">@lang('labels.contact')</li>
  </ol>

  <div>
    <h1>@lang('labels.contact')</h1>
    <hr>
  </div>

  <div class="row">
    <div class="col-lg-7">

      <iframe width="100%" height="400px" frameborder="0" style="border:0"  src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ64ZLtybWx0cRxGkhGd2kHF8&key=AIzaSyBgem0VuA0WKKKDXGDZuHf6cCHJKvJW8Mw" allowfullscreen></iframe>

    </div>
    <div class="col-lg-5">
      @include('flash::message')

      <form class="" action="{{route('postcontact')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
          <label for="name">@lang('labels.name')</label>
          <input type="text" class="form-control" name="name" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="email">@lang('labels.email')</label>
          <input type="email" class="form-control" type="email" name="email" placeholder="" required>
        </div>

        <div class="form-group">
          <label for="subject">@lang('labels.subject')</label>
          <select type="text" class="form-control" name="subject" placeholder="" required>
            <option value="question">@lang('labels.question')</option>
            <option value="problem">@lang('labels.problem')</option>
            <option value="suggestion">@lang('labels.suggestion')</option>
          </select>
        </div>

        <div class="form-group">
          <label for="description">@lang('labels.description')</label>
          <textarea rows="5" class="form-control" name="description" placeholder="" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary pull-right" name="button">@lang('labels.send')</button>
      </form>
    </div>
  </div>

</div>


@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
