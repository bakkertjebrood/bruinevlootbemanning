@extends('adminlte::page')

@section('title', 'No access...')

@section('content_header')
<h3>No access</h3>
@stop

@section('content')
<div class="error-page">
        <h2 class="headline text-red">401</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! No permission to view this.</h3>
          <p>Please contact your system administrator to gain access.</p>
      </div>
@stop
