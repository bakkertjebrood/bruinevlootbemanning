@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')

@stop
@section('content')
<div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><small><a href="{{url('/')}}">Welkom</a></small></li>
    <li class="breadcrumb-item active" aria-current="page">Vacature {{$ad->name}}</li>
  </ol>

  <div class="col-lg-8">
    <h3>{{$ad->name}}</h3>
    <div class="ad_page">
      <div class="ad_page_header">

      </div>
      <div class="ad_page_body">
        <div class="well well-sm">
          <p>{{$ad->description}}</p>
        </div>


      <div class="list-group">
          <div class="list-group-item">
            <h4>Thuishaven</h4>
            <p>{{$ad->homeport}}</p>
          </div>

          <div class="list-group-item">
          <h4>Benodigde vaardigheden</h4>
          <div>
            <span>
              @foreach($ad->skills as $skill)
              {{strToLower($skill->name)}}
              @endforeach
            </span>
          </p>
        </div>
      </div>
      <div class="list-group-item">
        <h4>Periode</h4>
        <p>{{date_format(new DateTime($ad->startdate),'d-m-Y')}} tot {{date_format(new DateTime($ad->enddate),'d-m-Y')}}</p>
      </div>
      </div>

      <h4>Reageren op deze vacature</h4>
      <p>  @if (Auth::guest())
        <a type="button" data-toggle="modal" data-target="#ad_respond" class="btn btn-xl btn-primary" name="button">Reageren</a>
        @else
        @endif</p>
      </div>
    </div>
  </div>

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

  <div class="col-lg-4">
    <div class="ad_photo">
      <img class="img img-thumbnail img-responsive" src="{{$ad->photo}}" alt="">
    </div><br>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">{{$ad->user->name}}</h3>
      </div>
      <div class="panel-body profile-small">
        <img class="thumbnail" src="{{$ad->user->photo}}" alt="">
        <p>{{str_limit($ad->user->description,200)}}</p>
      </div>
    </div>

    <div class="list-group">
      <div class="list-group-item">
        <strong>Aangemaakt:</strong> {{date_format($ad->created_at,'d-m-Y')}}
      </div>
      <div class="list-group-item">
        <strong>Laatst gewijzigd:</strong> {{date_format($ad->updated_at,'d-m-Y')}}
      </div>
    </div>

    <!--hier -->

  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
