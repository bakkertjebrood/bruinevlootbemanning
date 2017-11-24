@extends('adminlte::page')

@section('title', 'Departments')

@section('content_header')

@stop

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Departments</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <button type="button" data-target="#create-department" data-toggle="modal" class="btn btn-primary btn-xs" name="button">Create new Department</button>
    </div>
  </div>
  <div class="box-body">
    <table id="departments-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
        <th width="110px">Action</th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">

  </div>
</div>

<!-- Create department -->
    <div class="modal fade" id="create-department" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Create new department</h4>
          </div>
          <div class="modal-body">
            <form id="create-form" data-toggle="validator" action="/departments/data" method="post">
              <!-- <input type="hidden" id="image_edit_input" name="image" value=""> -->
              <div class="form-group">
                <label class="control-label" for="title">Name</label>
                <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
                <div class="help-block with-errors"></div>
              </div>

              <!-- <div class="form-group">
                <label class="control-label" for="parent_id">Parent department</label>
                <select id="select-departments" style="width:100%" name="parent_id" class="form-control select-departments" data-error="Please enter title." /></select>
                <div class="help-block with-errors"></div>
              </div> -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>

<!-- Edit department -->
    <div class="modal fade" id="edit-department" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Edit department</h4>
          </div>
          <div class="modal-body">
            <form id="edit-form" data-toggle="validator" action="/departments/data" method="post">
              <input type="hidden" id="id" name="id" value="">
              <div class="form-group">
                <label class="control-label" for="title">Name</label>
                <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." />
                <div class="help-block with-errors"></div>
              </div>

              <!-- <div class="form-group">
                <label class="control-label" for="parent_id">Parent department</label><br>
                <select style="width:100%" name="parent_id" class="form-control select-departments" required /></select>
                <div class="help-block with-errors"></div>
              </div> -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
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

var tableData = $('#departments-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: '/departments/data',
  rowGroup: {
    dataSrc: 'parent_id'
  },
  columnDefs:[{
    'targets': [0,2],
    'visible': false,
    'searchable': false
  }],
  columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'parent_id', name: 'parent_id'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
  ]
});

// Populate select2
$('body').find('.select-departments').select2({
            placeholder: 'Enter a parent department',
            ajax: {
                dataType: 'json',
                url: '{{ url("departments/list") }}',
                delay: 400,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function (data, page) {
                  return {
                    results: data
                  };
                },
            }
});

// Create department
$("#create-form").submit(function(e){
  e.preventDefault();
  var form_action = $("#create-department").find("form").attr("action");
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/departments/data',
    data:content
  }).done(function(data){
    $("#create-department").modal('hide');
    $("#create-department").find(':input').val('');
    $("#create-department").find(':input').removeClass('has-error');
    //toast;
    toastr.success('The employee has been created');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('Warning');
  });
});

// Delete department
$('body').on('click','.delete-department',function(){
var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'DELETE',
    url: '/departments/data/'+id,
    //data:content
  }).done(function(data){
    toastr.success('The employee has been deleted');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('Warning');
  });
});

// Get department data before editing
$('body').on('click','.edit-department', function(){
var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/departments/data/'+id,
  }).done(function(data){
    $('#edit-department').find('#name').val(data.name);
    $('#edit-department').find('#parent_id').val(data.parent_id);
    $('#edit-department').find('#id').val(data.id);

  });
});

/* Edit department */
$("#edit-form").submit(function(e){
  e.preventDefault();
  // var form_action = $("#edit-department").find("form").attr("action");
  var id = $('#edit-department').find('#id').val();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'PUT',
    url: '/departments/data/'+id,
    data:content
  }).done(function(data){
    $("#create-department").modal('hide');
    $("#create-department").find(':input').val('');
    $("#create-department").find(':input').removeClass('has-error');
    //toast;
    toastr.success('The employee has been edited');
    tableData.ajax.reload();
    $("#edit-department").modal('hide');
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('Warning');
  });
});
</script>
@stop
