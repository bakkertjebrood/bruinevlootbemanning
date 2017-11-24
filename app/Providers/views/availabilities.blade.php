@extends('adminlte::page')

@section('title', 'Availabilities')

@section('content_header')

@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{trans('adminlte::adminlte.search')}}</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <form  id="search-form" class="" action="index.html" method="get">
          <div class="form-group">
          <label for="username">{{trans('adminlte::adminlte.full_name')}}</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-user"></i>
            </div>
          <select width="100%" type="text" name="username" id="s_users" class="form-control select-users" value="" placeholder="">
            @if(Session::get('availability_users'))
            @foreach(Session::get('availability_users') as $user)
            <option value="{{$user->id}}" selected="selected">{{$user->name}}</option>
            @endforeach
            @endif
          </select>
        </div>
        </div>


      </div>
      <div class="box-footer">
  <button type="submit" class="btn btn-primary pull-right" name="button">{{trans('adminlte::adminlte.search')}}</button>
  </form>
      </div>
    </div>
  </div>
</div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{trans('adminlte::adminlte.availabilities')}}</h3>
      <div class="box-tools pull-right">
        <button type="button" data-target="#create-availability-year" data-toggle="modal" class="btn btn-primary btn-xs" name="button" id="create-availability-year-btn">{{trans('adminlte::adminlte.add_availabilities')}}</button>
      </div>
    </div>
    <div class="box-body">
      <table id="availabilities-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <th>Month num</th>
          <th>{{trans('adminlte::adminlte.employee')}}</th>
          <th>Year</th>
          <th>{{trans('adminlte::adminlte.month')}}</th>
          <th>{{trans('adminlte::adminlte.fte')}}</th>
          <th>{{trans('adminlte::adminlte.leave')}}</th>
          <th>{{trans('adminlte::adminlte.margin')}}</th>
          <th>{{trans('adminlte::adminlte.illness')}}</th>
          <th width="110px">{{trans('adminlte::adminlte.action')}}</th>
        </thead>

      </table>
    </div>
    <div class="box-footer">

    </div>
  </div>

      <!-- Create availability year -->
          <div class="modal fade" id="create-availability-year" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 id="create-availability-year-title" class="modal-title" id=""></h4>
                </div>
                <div class="modal-body">
                  <form id="create-form-availabilities-year" data-toggle="validator" action="/availabilities/data" method="post">
                    <input type="hidden" id="user_id" name="user_id" value="">

                    <div class="form-group">
                      <label class="control-label" for="title">{{trans('adminlte::adminlte.year')}}</label>
                      <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="year" name="year" value="" class="form-control pull-right dateyear" placeholder="Select year" data-error="Please enter year." required />
                      </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="title">{{trans('adminlte::adminlte.fte')}}</label>
                        <select style="width:100%" type="text" id="FTE" name="fte" class="form-control" data-error="Please enter title." required /></select>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="title">{{trans('adminlte::adminlte.leave')}}</label>
                        <select style="width:100%" type="text" id="leave" name="leave" class="form-control" data-error="Please enter title." required /></select>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="title">{{trans('adminlte::adminlte.margin')}}</label>
                        <select style="width:100%" type="text" id="margin" name="margin" class="form-control" data-error="Please enter title." required /></select>
                        <div class="help-block with-errors"></div>
                      </div>

                      <div class="form-group">
                        <label class="control-label" for="title">{{trans('adminlte::adminlte.illness')}}</label>
                        <select style="width:100%" type="text" id="illness" name="illness" class="form-control" data-error="Please enter title." required /></select>
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

initSelect();
initDatepicker();

var tableData = $('#availabilities-table').DataTable({
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
  drawCallback: function(settings){
   var api = this.api();
   // Initialize custom control
   initSelect(api.table());
},
  ajax: {
    url:'/availabilities/data',
    data: function (d) {
       d.name = $('.select-users').select2('val');
}},

  order: [[2, 'asc'],[0, 'asc']],
  group: [[2]],
  rowGroup: {
    dataSrc: ['name']
  },
  columnDefs:[
    {
      'targets': [0,1,2],
      'visible': false,
      'searchable':false
    }
  ],
  columns: [
      {data: 'month_num', name: 'month_num'},
      {data: 'name', name: 'name'},
      {data: 'year', name: 'year'},
      {data: 'month', name: 'month'},
      {data: 'fte', name: 'fte'},
      {data: 'leave', name: 'leave'},
      {data: 'margin', name: 'margin'},
      {data: 'illness', name: 'illness'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
  ]

});

$('#search-form').find('#s_users').change(function(e) {
    tableData.draw();
    e.preventDefault();
});

// Get values for create availability whole year
$('#create-availability-year-btn').on('click', function(){
  var user_id = $('#search-form').find('#s_users').val();
  var title = $('#search-form').find('#s_users option:selected').text();
  $('#create-availability-year').find('#user_id').val(user_id);
  $('#create-availability-year-title').html('{{trans("adminlte::adminlte.add_availabilities")}} {{trans("adminlte::adminlte.for")}} '+title);
  selectData();
});


// Create availability whole year
$("#create-form-availabilities-year").submit(function(e){
  e.preventDefault();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/availabilities/year',
    data:content
  }).done(function(data){
    $("#create-availability-year").modal('hide');
    $("#create-availability-year").find(':input').val('');
    $("#create-availability-year").find(':input').removeClass('has-error');
    toastr.success('{{trans("adminlte::adminlte.added_availabilities")}}');
    tableData.ajax.reload();
  }).fail( function(data,xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});

// Delete availability
$('body').on('click','.delete-availability',function(){
var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'DELETE',
    url: '/availabilities/data/'+id,
    //data:content
  }).done(function(data){
    toastr.success('{{trans("adminlte::adminlte.deleted_availabilities")}}');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});

// Get availability data before editing
$('body').on('click','.edit-availability', function(){
var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/availabilities/data/'+id,
  }).done(function(data){
    $('#edit-availability').find("#user_id").val('change');
    $('#edit-availability').find('#year').val(data.year);
    $('#edit-availability').find('#month').val(data.month);
    $('#edit-availability').find('#fte').val(data.fte);
    $('#edit-availability').find('#leave').val(data.leave);
    $('#edit-availability').find('#margin').val(data.margin);
    $('#edit-availability').find('#illness').val(data.illness);
    $('#edit-availability').find('#id').val(data.id);
  });
});

/* Edit availability from grid */
$('body').on('change','.editable',function(e){
  e.preventDefault();
  var id = $(this).closest('tr').find('.delete-availability').attr('data-id');
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'PUT',
    url: '/availabilities/data/'+id,
    data:content
  }).done(function(data){
    //toast;
    toastr.success('{{trans("adminlte::adminlte.updated_availabilities")}}');
    tableData.ajax.reload();
    $("#edit-availability").modal('hide');
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    toastr.warning('{{trans("adminlte::adminlte.error")}}');
  });
});
</script>
@stop
