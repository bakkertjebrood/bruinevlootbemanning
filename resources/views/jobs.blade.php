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
<div id="app">
<jobs></jobs>
</div>
</div>
@stop

@section('scripts')

<script type="text/javascript">

</script>

@stop
