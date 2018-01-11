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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <strong>
          <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
            Zijn mijn gegevens veilig?</a>
          </strong>
          </h4>
        </div>
        <div id="collapseTen" class="panel-collapse collapse in">
          <div class="panel-body">
            Alle gegevens van bruinevlootbemanning.nl worden op een beveiligde server opgeslagen en worden <strong>nooit</strong> aan derden verstrekt.
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <strong>
            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
              Hoelang is mijn advertentie geldig?</a>
            </strong>
            </h4>
          </div>
          <div id="collapseTen" class="panel-collapse collapse in">
            <div class="panel-body">
              Een advertentie is standaard na plaatsing twee maanden geldig. Na het verlopen van deze periode ontvangt u een bericht waarmee de advertentie kan worden verlengd.
            </div>
          </div>
        </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <strong>
            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">Hoe plaats ik een vacature?</a>
          </strong>
          </h4>
        </div>
        <div id="collapseEleven" class="panel-collapse collapse in">
          <div class="panel-body">
            Om een oproep te kunnen plaatsen dient u in de eerste plaats te <a href="{{route('register')}}">registreren</a>. Vervolgens kiest u in het menu voor ‘Plaats een vacature’ en vult u alle velden zo volledig mogelijk in. Als u hiermee klaar bent klikt u op ‘Opslaan’. De vacature is nu geplaatst en direct zichtbaar.
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <strong>
            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapsetwelve">Hoe plaats ik een oproep?</a>
          </strong>
          </h4>
        </div>
        <div id="collapsetwelve" class="panel-collapse collapse in">
          <div class="panel-body">
            Om een oproep te kunnen plaatsen dient u in de eerste plaats te <a href="{{route('register')}}">registreren</a>. Vervolgens kiest u in het menu voor ‘Plaats een oproep en vult u alle velden zo volledig mogelijk in. Als u hiermee klaar bent klikt u op ‘Opslaan’. De oproep is nu geplaatst en direct zichtbaar.
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <strong>
            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapsethirteen">Mijn cerfiticaat, vaardigheid of diploma staat er niet bij, wat nu?</a>
          </strong>
          </h4>
        </div>
        <div id="collapsethirteen" class="panel-collapse collapse in">
          <div class="panel-body">
            Om uw certificaat, vaardigheid of diploma toe te laten voegen aan <strong>Bruine</strong>Vloot<small>bemanning.nl</small>, kunt u dit formulier invullen. Het wordt zo snel mogelijk in behandeling genomen. U krijgt bericht zodra het is toegevoegd.
          </div>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <strong>
            <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion" href="#collapsefourteen">Ik heb een andere vraag..</a>
          </strong>
          </h4>
        </div>
        <div id="collapsefourteen" class="panel-collapse collapse in">
          <div class="panel-body">
            <a href="{{route('contact')}}">Stel hier uw vraag aan <strong>Bruine</strong>Vloot<small>bemanning.nl</small></a>
          </div>
        </div>
      </div>

    </div>
  </div>


  @stop

  @section('scripts')
  <script type="text/javascript">

  </script>
  @stop
