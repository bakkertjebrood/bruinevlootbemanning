@extends('layouts.app')

@section('title')
Bruinevlootbemanning
@stop

@section('header')

@stop
@section('content')
<div class="container-fluid main_image">
  <div class="container">
    <div class="phrase pull-right">
      <h1>Schippers, matrozen, horeca personeel en klussers gevraagd</h1>
      <p>Van student tot pensionado, van starter tot ervaren bemanningslid, iedereen is welkom! Er is werk te doen aan boord van prachtige historische schepen binnen of buiten het vaar seizoen. Schrijf je dus in of ben je scheepseigenaar, plaats jouw vacature en kom in contact met mede enthousiastelingen.</p>
    </div>
  </div>
</div>
<div class="container-fluid call-to-action">
  <div class="container">
    <div class="pull-right">
        @if (Auth::guest())
        <button type="button" class="btn btn-l btn-login" name="button">Inloggen</button>
        @else
        @endif
      <button type="button" class="btn btn-l btn-backend" name="button">Werkgever</button>
</div>
</div>
</div>

<div class="container">

  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><small>Home</small></li>
  </ol>

  <div class="row">

    <!-- Main ads grid -->
    <div class="col-lg-9">
      <div class="title">
        <h1>Vacatures</h1>
      </div>

      <hr>

      <div class="ads">
        @foreach($ads as $ad)
        <div class="ad">
          <div>
            <h3>{{$ad->name}}</h3>
          </div>
          <div class="pull-right">
            <small class="ad-created">Aangemaakt op: {{date_format($ad->created_at,'d-m-Y')}}</small>
          </div>


          <div class="wrapper clearfix">
            <img class="img-thumbnail" src="{{$ad->photo}}" alt="">
            <strong>Omschrijving</strong>
            <p>{{str_limit($ad->description,250)}}</p>

            <strong>Vaardigheden:</strong>
            <p>[[skills]]</p>

            <strong>Periode:</strong>
            <p>{{date_format(new DateTime($ad->startdate),'d-m-Y')}} tot {{date_format(new DateTime($ad->enddate),'d-m-Y')}}</p>

            <div class="footer">
              <button type="button" class="btn btn-m pull-right" name="respond">Reageer</button>
            </div>
          </div>

        </div>

        @endforeach
      </div>

      <div class="pagination">
        {{$ads->links()}}
      </div>
    </div>

    <div class="col-lg-3">
      <!-- Search -->
      <div class="">
        <form class="" action="/search" method="get">
          <div class="form-group">
            <label for="search">Zoeken</label>
            <input type="text" class="form-control" id="search" placeholder="Wat zoekt u?">
          </div>
        </form>
      </div>

      <!-- Search categories -->
      <div class="categories">
        <form class="" action="index.html" method="post">
          <label for="categories">Zoek op categorie</label>
          <div class="list-group" id="categories">
          @foreach($categories as $category)
              <a class="list-group-item list-group-item-action">{{$category->name}}</a>
          @endforeach
        </div>
        </form>
      </div>

      <!-- Search skills -->
      <div class="skills">
        <form class="" action="index.html" method="post">
          <label for="skills">Zoek op bevoegdheden</label>
          <div class="list-group" id="skills">
          @foreach($skills as $skill)
              <a class="list-group-item list-group-item-action">{{$skill->name}}</a>
          @endforeach
        </div>
        </form>
      </div>

      <!-- Start / end -->
      <div class="daterange">
        <form class="" action="index.html" method="post">
          <label for="daterange">Datum bereik</label>
          <div class="input-group input-daterange" id="daterange">
            <input type="text" class="form-control datepicker" value="" placeholder="01-01-2018">
            <div class="input-group-addon">tot</div>
            <input type="text" class="form-control datepicker" value="" placeholder="01-01-2019">
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
