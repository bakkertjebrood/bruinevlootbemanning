@extends('adminlte::page')

@section('title', trans('adminlte::adminlte.workabledays'))

@section('content_header')

@stop

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">{{trans('adminlte::adminlte.workabledays')}}</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <button type="button" data-target="#create-workableday" data-toggle="modal" class="btn btn-primary btn-xs" name="button">{{trans('adminlte::adminlte.create_workableday')}}</button>
    </div>
  </div>
  <div class="box-body">
    <table id="workabledays-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <th>ID</th>
        <th>{{trans('adminlte::adminlte.year')}}</th>
        <th>{{trans('adminlte::adminlte.month')}}</th>
        <th>{{trans('adminlte::adminlte.workabledays')}}</th>
        <th width="160px">{{trans('adminlte::adminlte.action')}}</th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">

  </div>
</div>

<!-- Create workableday -->
<div class="modal fade" id="create-workableday" tabindex="-1" workableday="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">{{trans('adminlte::adminlte.create_workableday')}}</h4>
      </div>
      <div class="modal-body">
        <form id="create-form" data-toggle="validator" action="/workabledays/data" method="post">

          <div class="form-group">
            <label class="control-label" for="title">{{trans('adminlte::adminlte.year')}}</label>
            <input type="text" id="year" name="year" class="form-control dateyear" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <label class="control-label" for="title">{{trans('adminlte::adminlte.month')}}</label>
            <input type="text" id="month" name="month" class="form-control datemonth" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <label class="control-label" for="title">{{trans('adminlte::adminlte.workabledays')}}</label>
            <input type="text" id="days" name="days" class="form-control" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('adminlte::adminlte.close')}}</button>
          <button type="submit" class="btn btn-primary">{{trans('adminlte::adminlte.save')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit workableday -->
<div class="modal fade" id="edit-workableday" tabindex="-1" workableday="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">{{trans('adminlte::adminlte.edit_workableday')}}</h4>
      </div>
      <div class="modal-body">
        <form id="edit-form" data-toggle="validator" action="/workabledays/data" method="post">
          <input type="hidden" id="id" name="id" value="">

          <div class="form-group">
            <label class="control-label" for="title">{{trans('adminlte::adminlte.year')}}</label>
            <input type="text" id="year" name="year" class="form-control dateyear" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <label class="control-label" for="title">{{trans('adminlte::adminlte.month')}}</label>
            <input type="text" id="month" name="month" class="form-control datemonth" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <label class="control-label" for="title">{{trans('adminlte::adminlte.workabledays')}}</label>
            <input type="text" id="days" name="days" class="form-control" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('adminlte::adminlte.close')}}</button>
          <button type="submit" class="btn btn-primary">{{trans('adminlte::adminlte.save')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
@section('custom_scripts')
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

initDatepicker();

var tableData = $('#workabledays-table').DataTable({
  processing: true,
  serverSide: true,
  pageLength: 12,
  "language": {
    "lengthMenu": "{{trans('adminlte::adminlte.show_records')}} _MENU_ {{trans('adminlte::adminlte.per_page')}}",
    "zeroRecords": "{{trans('adminlte::adminlte.no_records')}}",
    "info": "{{trans('adminlte::adminlte.showing_page')}} _PAGE_ {{trans('adminlte::adminlte.of')}} _PAGES_",
    "infoEmpty": "{{trans('adminlte::adminlte.no_records')}}",
    "infoFiltered": "(filtered from _MAX_ total records)",
    "search": "{{trans('adminlte::adminlte.search')}}",
    paginate: {
      first:      "{{trans('adminlte::adminlte.first')}}",
      previous:   "{{trans('adminlte::adminlte.previous')}}",
      next:       "{{trans('adminlte::adminlte.next')}}",
      last:       "{{trans('adminlte::adminlte.last')}}"
    },
  },
  ajax: '/workabledays/data',
  columnDefs:[
    {
      'targets': [0],
      'visible': false,
      'searchable': false
    }
  ],
  columns: [
    {data: 'id', name: 'id'},
    {data: 'year', name: 'year'},
    {data: 'month', name: 'month'},
    {data: 'days', name: 'days'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
  ],
  order: [[1, 'asc'],[2, 'asc']],
});

// Create workableday
$("#create-form").submit(function(e){
  e.preventDefault();
  var form_action = $("#create-workableday").find("form").attr("action");
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/workabledays/data',
    data:content
  }).done(function(data){
    $("#create-workableday").modal('hide');
    $("#create-workableday").find(':input').val('');
    $("#create-workableday").find(':input').removeClass('has-error');
    //toast;
    toastr.success('{{trans("adminlte::adminlte.created_workableday")}}');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});

// Delete workableday
$('body').on('click','.delete-workableday',function(){
  var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'DELETE',
    url: '/workabledays/data/'+id,
    //data:content
  }).done(function(data){
    toastr.success('{{trans("adminlte::adminlte.deleted_workableday")}}');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});

// Get workableday data before editing
$('body').on('click','.edit-workableday', function(){
  var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/workabledays/data/'+id,
  }).done(function(data){
    $('#edit-workableday').find('#id').val(data.id);
    $('#edit-workableday').find('#year').val(data.year);
    $('#edit-workableday').find('#month').val(data.month);
    $('#edit-workableday').find('#days').val(data.days);

  });
});

/* Edit workableday */
$("#edit-form").submit(function(e){
  e.preventDefault();
  // var form_action = $("#edit-workableday").find("form").attr("action");
  var id = $('#edit-workableday').find('#id').val();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'PUT',
    url: '/workabledays/data/'+id,
    data:content
  }).done(function(data){
    $("#create-workableday").modal('hide');
    $("#create-workableday").find(':input').val('');
    $("#create-workableday").find(':input').removeClass('has-error');
    //toast;
    toastr.success('{{trans("adminlte::adminlte.updated_workableday")}}');
    tableData.ajax.reload();
    $("#edit-workableday").modal('hide');
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});
</script>
@stop
