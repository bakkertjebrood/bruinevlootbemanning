@extends('adminlte::page')

@section('title', 'Dashboard Capacity Manager')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">
  <div class="col-lg-6">
  <div class="info-box bg-green">
  <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Capacity number for {{Carbon::now()->format('F')}}</span>
    <span class="info-box-number">{{$projects}}</span>
    <!-- The progress section is optional -->
    <div class="progress">
      <div class="progress-bar" style="width: 0%"></div>
    </div>
    <span class="progress-description">
      70% Increase in 30 Days
    </span>
  </div>
  </div>
</div>

<div class="col-lg-6">
<div class="info-box bg-yellow">
<span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
<div class="info-box-content">
  <span class="info-box-text">Total number of employees</span>
  <span class="info-box-number">{{$users}}</span>
  <!-- The progress section is optional -->
  <div class="progress">
    <div class="progress-bar" style="width: 10%"></div>
  </div>
  <span class="progress-description">
    70% Increase in 30 Days
  </span>
</div>
</div>
</div>

</div>
<div class="row">

  <div id="box1" class="col-lg-3">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="ion ion-ios-medkit-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{trans('adminlte::adminlte.quick_add_illness')}}</span>
        <form id="add_illness" data-toggle="validator" action="" method="post">
          <div class="form-group">
            <select style="width:100%" class="form-control select-users" id="" name="user_id" placeholder=""></select>
          </div>

          <div class="form-group">
            <input width="100%" class="form-control datemonthyear" name="monthyear" id="" placeholder="Enter a month"></input>
          </div>

          <div class="form-group">
            <select style="width:100%" class="form-control select-days" name="days" id="" placeholder=""></select>
          </div>

          <div class="clearfix">
            <button type="submit" id="submitillness" class="btn btn-primary pull-right animate">{{trans('adminlte::adminlte.save')}}</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div id="box2" class="col-lg-3">
    <div class="info-box">
      <span class="info-box-icon bg-blue"><i class="ion ion-android-plane"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{trans('adminlte::adminlte.quick_add_leave')}}</span>
        <form id="add_leave" data-toggle="validator" action="" method="post">
          <div class="form-group">
            <select style="width:100%" class="form-control select-users" id="" name="user_id" placeholder=""></select>
          </div>

          <div class="form-group">
            <input width="100%" class="form-control datemonthyear" name="monthyear" id="" placeholder="Enter a month"></input>
          </div>

          <div class="form-group">
            <select style="width:100%" class="form-control select-days" name="days" id="" placeholder=""></select>
          </div>

          <div class="clearfix">
            <button type="submit" id="submitleave" class="btn btn-primary pull-right animate">{{trans('adminlte::adminlte.save')}}</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-3">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-podium"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{trans('adminlte::adminlte.quick_add_fte')}}</span>
        <form id="add_fte" data-toggle="validator" action="" method="post">
          <div class="form-group">
            <select style="width:100%" class="form-control select-users" id="" name="user_id" placeholder=""></select>
          </div>

          <div class="form-group">
            <input width="100%" class="form-control datemonthyear" name="monthyear" id="" placeholder="Enter a month"></input>
          </div>

          <div class="form-group">
            <select style="width:100%" class="form-control select-fte" name="fte" id="" placeholder=""></select>
          </div>

          <div class="clearfix">
            <button type="submit" id="submitfte" class="btn btn-primary pull-right animate">{{trans('adminlte::adminlte.save')}}</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-3">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-timer"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{trans('adminlte::adminlte.quick_add_margin')}}</span>
        <form id="add_margin" data-toggle="validator" action="" method="post">
          <div class="form-group">
            <select style="width:100%" class="form-control select-users" id="" name="user_id" placeholder=""></select>
          </div>

          <div class="form-group">
            <input width="100%" class="form-control datemonthyear" name="monthyear" id="" placeholder="Enter a month"></input>
          </div>

          <div class="form-group">
            <select style="width:100%" class="form-control select-margin" name="margin" id="" placeholder=""></select>
          </div>

          <div class="clearfix">
            <button type="submit" id="submitmargin" class="btn btn-primary pull-right animate">{{trans('adminlte::adminlte.save')}}</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


  <ul class="timeline">

      <!-- timeline time label -->
      <li class="time-label">
          <span class="bg-red">
              10 Feb. 2014
          </span>
      </li>
      <!-- /.timeline-label -->

      <!-- timeline item -->
      <li>
          <!-- timeline icon -->
          <i class="fa fa-envelope bg-blue"></i>
          <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

              <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

              <div class="timeline-body">
                  ...
                  Content goes here
              </div>

              <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">...</a>
              </div>
          </div>
      </li>
      <!-- END timeline item -->
      <!-- timeline item -->
      <li>
          <!-- timeline icon -->
          <i class="fa fa-envelope bg-blue"></i>
          <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

              <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>

              <div class="timeline-body">
                  ...
                  Content goes here
              </div>

              <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">...</a>
              </div>
          </div>
      </li>
      <!-- END timeline item -->

  </ul>


@stop

@section('custom_scripts')
<script type="text/javascript">


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
initSelect();
initDatepicker();

// Add illness
$("#add_illness").submit(function(e){
  e.preventDefault();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/add_illness',
    data:content
  }).done(function(data){
    // $("#add_illness").find(':input').val('');
    // $("#add_illness").find(':input').removeClass('has-error');

    $('#submitillness').html('{{trans("adminlte::adminlte.added_illness")}}').removeClass('btn-primary').addClass('btn-success');
    function setToOrginalState(){
      $('#submitillness').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-success').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);

  }).fail( function(xhr, textStatus, errorThrown) {

    $('#submitillness').html('{{trans("adminlte::adminlte.cannot_add")}}').removeClass('btn-primary').addClass('btn-danger');
    function setToOrginalState(){
      $('#submitillness').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-danger').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);


  });
});

// Add leave
$("#add_leave").submit(function(e){
  e.preventDefault();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/add_leave',
    data:content
  }).done(function(data){

    $('#submitleave').html('{{trans("adminlte::adminlte.added_leave")}}').removeClass('btn-primary').addClass('btn-success');
    function setToOrginalState(){
      $('#submitleave').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-success').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);

  }).fail( function(xhr, textStatus, errorThrown) {

    $('#submitleave').html('{{trans("adminlte::adminlte.cannot_add")}}').removeClass('btn-error').addClass('btn-danger');
    function setToOrginalState(){
      $('#submitleave').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-danger').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);

  });
});

// Change FTE
$("#add_fte").submit(function(e){
  e.preventDefault();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/add_fte',
    data:content
  }).done(function(data){

    $('#submitfte').html('{{trans("adminlte::adminlte.added_fte")}}').removeClass('btn-primary').addClass('btn-success');
    function setToOrginalState(){
      $('#submitfte').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-success').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);

  }).fail( function(xhr, textStatus, errorThrown) {

    $('#submitfte').html('{{trans("adminlte::adminlte.cannot_add")}}').removeClass('btn-error').addClass('btn-danger');
    function setToOrginalState(){
      $('#submitfte').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-danger').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);

  });
});

// Change margin
$("#add_margin").submit(function(e){
  e.preventDefault();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/add_margin',
    data:content
  }).done(function(data){

    $('#submitmargin').html('{{trans("adminlte::adminlte.added_margin")}}').removeClass('btn-primary').addClass('btn-success');
    function setToOrginalState(){
      $('#submitmargin').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-success').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);

  }).fail( function(xhr, textStatus, errorThrown) {

    $('#submitmargin').html('{{trans("adminlte::adminlte.cannot_add")}}').removeClass('btn-error').addClass('btn-danger');
    function setToOrginalState(){
      $('#submitmargin').html('{{trans("adminlte::adminlte.save")}}').fadeIn('slow').removeClass('btn-danger').addClass('btn-primary');
    }
    setTimeout(setToOrginalState, 2000);

  });
});
</script>
@endsection
