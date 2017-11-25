@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.poster')
@include('inc.cta')
@stop
@section('content')
<div class="container">

  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><small>Welkom</small></li>
  </ol>

    <!-- Main ads grid -->
    <div class="col-lg-9">
      <div>
        <h1>Vacatures</h1>
        <hr>
      </div>

      @foreach($ads as $ad)
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">{{$ad->name}}</h3>
        </div>
        <div class="panel-body">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object ads-image " src="{{$ad->photo}}" alt="Photo">
              </a>
            </div>
            <div class="media-body">

              <h4 class="media-heading">Omschrijving</h4>
              <p>{{str_limit($ad->description,250)}}</p>

              <span><strong>Vaardigheden: </strong>
                @foreach($ad->skills as $skill)
                {{strToLower($skill->name)}}
                @endforeach
              </span><br>

              <span><strong>Periode:</strong> {{date_format(new DateTime($ad->startdate),'d-m-Y')}} tot {{date_format(new DateTime($ad->enddate),'d-m-Y')}}</span><br>

              <span><strong>Geplaatst op:</strong> {{date_format($ad->created_at,'d-m-Y')}}</span>
            </div>
          </div>
        </div>
        <div class="panel-footer clearfix">
          <span class="pull-right ">
                       <a type="button" class="btn btn-m btn-default" href="{{route('ad',$ad->id)}}" name="button">Meer informatie</a>
                       <a type="button" class="btn btn-m btn-primary" data-toggle="modal" data-target="#ad_respond" name="respond">Reageer</a>
                       </span>
        </div>
      </div>
@endforeach
      <div class="pagination">
        {{$ads->links()}}
      </div>
    </div>

<!-- Respond to ad -->
    <div class="modal fade" id="ad_respond" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="ad_respond"></h4>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
            <button type="button" class="btn btn-primary">Versturen</button>
          </div>
        </div>
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
@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
