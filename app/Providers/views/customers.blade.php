@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')

@stop

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">{{trans('adminlte::adminlte.customers')}}</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <button type="button" data-target="#create-customer" data-toggle="modal" class="btn btn-primary btn-xs" name="button">{{trans('adminlte::adminlte.create_customer')}}</button>
    </div>
  </div>
  <div class="box-body">
    <table id="customers-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <th>ID</th>
        <th>{{trans('adminlte::adminlte.name')}}</th>
        <th width="160px">{{trans('adminlte::adminlte.action')}}</th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">

  </div>
</div>

<!-- Create customer -->
    <div class="modal fade" id="create-customer" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">{{trans('adminlte::adminlte.create_customer')}}</h4>
          </div>
          <div class="modal-body">
            <form id="create-form" data-toggle="validator" action="/customers/data" method="post">
            <div class="form-group">
                <label class="control-label" for="title">{{trans('adminlte::adminlte.name')}}</label>
                <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
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

<!-- Edit customer -->
    <div class="modal fade" id="edit-customer" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">{{trans('adminlte::adminlte.edit_customer')}}</h4>
          </div>
          <div class="modal-body">
            <form id="edit-form" data-toggle="validator" action="/customers/data" method="post">
              <input type="hidden" id="id" name="id" value="">
              <div class="form-group">
                <label class="control-label" for="title">{{trans('adminlte::adminlte.name')}}</label>
                <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
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

var tableData = $('#customers-table').DataTable({
  processing: true,
  serverSide: true,
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
  ajax: '/customers/data',
  columnDefs:[
    {
      'targets': [0],
      'visible': false,
      'searchable': false
  }
],
  columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
  ]
});

// Populate select2
$('body').find('.select-customers').select2({
            placeholder: 'Enter a parent customer',
            ajax: {
                dataType: 'json',
                url: '{{ url("customers/list") }}',
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

// Create customer
$("#create-form").submit(function(e){
  e.preventDefault();
  var form_action = $("#create-customer").find("form").attr("action");
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/customers/data',
    data:content
  }).done(function(data){
    $("#create-customer").modal('hide');
    $("#create-customer").find(':input').val('');
    $("#create-customer").find(':input').removeClass('has-error');
    //toast;
    toastr.success('{{trans("adminlte::adminlte.created_customer")}}');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});

// Delete customer
$('body').on('click','.delete-customer',function(){
var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'DELETE',
    url: '/customers/data/'+id,
    //data:content
  }).done(function(data){
    toastr.success('{{trans("adminlte::adminlte.deleted_customer")}}');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});

// Get customer data before editing
$('body').on('click','.edit-customer', function(){
var id = $(this).attr('data-id');
console.log(id);

  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/customers/data/'+id,
  }).done(function(data){
    $('#edit-customer').find('#name').val(data.name);
    $('#edit-customer').find('#parent_id').val(data.parent_id);
    $('#edit-customer').find('#id').val(data.id);

  });
});

/* Edit customer */
$("#edit-form").submit(function(e){
  e.preventDefault();
  // var form_action = $("#edit-customer").find("form").attr("action");
  var id = $('#edit-customer').find('#id').val();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'PUT',
    url: '/customers/data/'+id,
    data:content
  }).done(function(data){
    $("#create-customer").modal('hide');
    $("#create-customer").find(':input').val('');
    $("#create-customer").find(':input').removeClass('has-error');
    //toast;
    toastr.success('{{trans("adminlte::adminlte.updated_customer")}}');
    tableData.ajax.reload();
    $("#edit-customer").modal('hide');
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});
</script>
@stop
