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
    <li class="breadcrumb-item active" aria-current="page">Profiel {{Auth::user()->name}}</li>
  </ol>

  <div>
    <h1>Profiel</h1>
    <hr>
  </div>

  <div class="col-lg-8">



  @include('flash::message')

  <form  action="{{url('/user/profile')}}/{{Auth::user()->id}}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
      <label for="name">Gebruikersnaam</label>
      <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}" placeholder="Naam">
    </div>

    <div class="form-group">
      <label for="firstname">Voornaam</label>
      <input type="text" class="form-control" id="firstname" name="firstname" value="{{Auth::user()->firstname}}" placeholder="Voornaam">
    </div>

    <div class="form-group">
      <label for="lastname">Achternaam</label>
      <input type="text" class="form-control" id="lastname" name="lastname" value="{{Auth::user()->lastname}}" placeholder="Achternaam">
    </div>

    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="text" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" placeholder="E-mail">
    </div>

    <div class="form-group">
      <label for="description">Omschrijving</label>
      <textarea type="text" class="form-control" id="description" name="description" value="" placeholder="Omschrijving">{{Auth::user()->description}}</textarea>
    </div>

    <div class="form-group">
      <label for="phone">Telefoon</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{{Auth::user()->phone}}" placeholder="Telefoon">
    </div>

    <div class="form-group">
      <label for="city">Woonplaats</label>
      <input type="text" class="form-control" id="city" name="city" value="{{Auth::user()->city}}" placeholder="Woonplaats">
    </div>

    <div class="form-group">
      <label for="title">Functie</label>
      <input type="text" class="form-control" id="title" name="title" value="{{Auth::user()->title}}" placeholder="Functie">
    </div>

    <div class="form-footer pull-right">
      <button type="submit" class="btn btn-primary btn-l" name="button">Opslaan</button>
    </div>


  </form>

  </div>
  <div class="col-lg-4 profile">
    <img class="img img-thumbnail" src="/uploads/photo/{{Auth::user()->photo}}" alt="">
    <div class="form-group">
      <label class="control-label" for="title">Afbeelding</label>
      <div class="validation-errors"></div>
      <form  enctype="multipart/form-data" method="post" action="{{ route('profilephoto') }}" autocomplete="off">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="file" name="photo" class="form-control" name="image" />
    </div>
    <div class="form-footer pull-right">
      <button type="submit" class="btn btn-primary btn-l" name="button">Opslaan</button>
    </div>
  </form>

  <div class="list-group">
    <div class="list-group-item">
      <strong>Ingeschreven sinds:</strong> {{date_format(Auth::user()->created_at,'d-m-Y')}}
    </div>
    <div class="list-group-item">
      <strong>Laatst gewijzigd:</strong> {{date_format(Auth::user()->updated_at,'d-m-Y')}}
    </div>
  </div>

  </div>



  <!-- einde -->
</div>

@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
