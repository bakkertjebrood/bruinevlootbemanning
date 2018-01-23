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
    <li class="breadcrumb-item active" aria-current="page">De maker</li>
  </ol>

  <div>
    <h2>Over <strong>Bruine</strong>Vloot<small>Bemanning.nl</small></h2>
    <hr>
  </div>

  <div class="row">
    <div class="col-lg-5 col-lg-offset-1">
      <img class="img img-circle img-responsive" src="{{url('uploads/photo')}}/1513978585.jpg" alt="">
      <div class="centerme">
        <h4>Elmer Bakker  </h4>
        <span><a href="mailto:elmer@BruineVlootBemanning.nl">elmer@bruinevlootbemanning.nl</a></span>
      </div>
    </div>
    <div class="col-lg-5">
      <h4><strong>Over de maker</strong></h4>
      <p>Hallo, ik ben Elmer Bakker en ik ben degene die BruineVlootBemanning.nl heeft opgezet. Als de zoon van een charterschipper heb ik altijd al een voorliefde voor
      de branche gehad en omdat ik graag zou willen dat de historische zeilende schepen blijven varen, wil ik met deze website mijn steentje bijdragen.</p>
      <p>In mijn dagelijks leven ben ik webapplicatie ontwikkelaar en bouw ik diverse websites en applicaties. Daarnaast heeft het zeilen en varen nog altijd een belangrijke plek in mijn leven.
        </p><br>
        <h4><strong>Het initiatief</strong></h4>
        <p>Deze website is opgezet om scheepseigenaren en personeel op een eenvoudige manier met elkaar in contact te brengen. Ik hoop dat iedereen die deze website gebruikt, dit met plezier doet en er uiteraard een voordeel uithaalt.</p>
      <br>
      <p>Vriendelijke groet,<br>
        Elmer Bakker
      </p>

    </div>
  </div>

</div>


@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop
