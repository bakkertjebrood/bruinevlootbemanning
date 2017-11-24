@extends('adminlte::page')

@section('title', 'Projects')

@section('content_header')

@stop

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Projects</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <button type="button" id="btn-create-project" data-target="#create-project" data-toggle="modal" class="btn btn-primary btn-xs" name="button">Create new Project</button>
    </div>
  </div>
  <div class="box-body">
    <table id="projects-table" class="table table-striped" width="100%">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Customer</th>
        <th width="110px">Action</th>
      </thead>

    </table>
  </div>
  <div class="box-footer">

  </div>
</div>

<!-- Create project -->
<div class="modal fade" id="create-project" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Create new project</h4>
      </div>
      <div class="modal-body">
        <form id="create-form" data-toggle="validator" action="/projects/data" method="post">

          <div class="form-group">
            <label class="control-label" for="title">Name</label>
            <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <label class="control-label" for="title">Customer</label>
            <select type="text" id="customer" style="width:100%" name="customer_id" class="form-control select-customers" data-error="Please enter title." required />

          </select>
          <div class="help-block with-errors"></div>
        </div>
        <!-- Start customfields definitions-->
        @foreach($customfield_definitions as $customfield_definiton)
        @if($customfield_definiton->input_type == 'input')
        <div class="form-group">
          <label class="control-label" for="title">{{ucfirst($customfield_definiton->input_description)}}</label>
          <input placeholder="Enter {{$customfield_definiton->input_description}}" type="text" style="width:100%" name="content" id="c{{$customfield_definiton->id}}" value="" class="form-control customfield{{$customfield_definiton->id}}" data-error="Please enter title." required />
          <div class="help-block with-errors"></div>
        </div>

        @elseif($customfield_definiton->input_type == 'select')
        <div class="form-group">
          <label class="control-label" for="title">{{ucfirst($customfield_definiton->input_description)}}</label>
          <select placeholder="Select option" style="width:100%" name="content" id="c{{$customfield_definiton->id}}" value="" class="form-control customfield-select" data-error="Please enter title." required />
            <option value=""></option>
            @foreach($customfield_options as $customfield_option)
            @if($customfield_option->customfield_id == $customfield_definiton->id)
            <option value="{{$customfield_option->id}}">{{$customfield_option->content}}</option>
            @endif
            @endforeach
          </select>
          <div class="help-block with-errors"></div>
        </div>
        @endif
        @endforeach
        <!-- End customfields definitions-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
</div>

<!-- Edit project -->
<div class="modal fade" id="edit-project" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Edit new project</h4>
      </div>
      <div class="modal-body">
        <form id="edit-form" data-toggle="validator" action="/projects/data" method="post">
          <input type="hidden" id="id" name="id" value="">

          <div class="form-group">
            <label class="control-label" for="title">Name</label>
            <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <label class="control-label" for="title">Customer</label>
            <select type="text" id="customer" style="width:100%" name="customer_id" class="form-control select-customers" data-error="Please enter title." required /></select>
            <div class="help-block with-errors"></div>
          </div>

          <!-- Start customfields definitions-->
          @foreach($customfield_definitions as $customfield_definiton)
          @if($customfield_definiton->input_type == 'input')
          <div class="form-group">
            <label class="control-label" for="title">{{ucfirst($customfield_definiton->input_description)}}</label>
            <input placeholder="Enter {{$customfield_definiton->input_description}}" type="text" style="width:100%" name="content" id="e{{$customfield_definiton->id}}" value="" class="form-control customfield" data-error="Please enter title." required />
            <div class="help-block with-errors"></div>
          </div>

          @elseif($customfield_definiton->input_type == 'select')
          <div class="form-group">
            <label class="control-label" for="title">{{ucfirst($customfield_definiton->input_description)}}</label>
            <select placeholder="Select option" style="width:100%" name="content" id="e{{$customfield_definiton->id}}" value="" class="form-control customfield-select" data-error="Please enter title." required />
              <option value=""></option>
              @foreach($customfield_options as $customfield_option)
              @if($customfield_option->customfield_id == $customfield_definiton->id)
              <option value="{{$customfield_option->id}}">{{$customfield_option->content}}</option>
              @endif
              @endforeach
            </select>
            <div class="help-block with-errors"></div>
          </div>
          @endif
          @endforeach
          <!-- End customfields definitions-->
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

var model = 'project';
$('.customfield-select').select2({placeholder: 'Enter value'});

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

initSelect();

// Projects datatable
var tableData = $('#projects-table').DataTable({
  processing: true,
  serverSide: true,
  ajax: '/projects/data',
  columnDefs:[{
    'targets':    [0],
    'visible':    false,
    'searchable': false
  }],
  columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'customer', name: 'customer'},
    {data: 'action', name: 'action', orderable: false, searchable: false}
  ]
});

// Create project
$("#create-form").submit(function(e){
  e.preventDefault();
  var form_action = $("#create-project").find("form").attr("action");
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'POST',
    url: '/projects/data',
    data:content
  }).done(function(data){
    customfield_create(data.id);
    $("#create-project").modal('hide');
    toastr.success('To be edited');
    tableData.ajax.reload();
  }).fail( function(xhr, textStatus, errorThrown) {
    tableData.ajax.reload();
    // toast;
    toastr.warning('Warning');
  });
});

// Delete project
$('body').on('click','.delete-project',function(){
  var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'DELETE',
    url: '/projects/data/'+id,
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

// Get project data before editing
$('body').on('click','.edit-project', function(){
  var id = $(this).attr('data-id');

  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/projects/data/'+id,
  }).done(function(data){
    customfield_show(id);
    $('#edit-project').find('#name').val(data.name);
    $('#edit-project').find('#id').val(data.id);
    $('#edit-project').find('#customer').html('<option value="'+data.customer_id+'">'+data.customer_name+'</option>');
  });
});

/* Edit project */
$("#edit-form").submit(function(e){
  e.preventDefault();
  var id = $('#edit-project').find('#id').val();
  var content = $(this).serialize();

  $.ajax({
    dataType: 'json',
    type:'PUT',
    url: '/projects/data/'+id,
    data:content
  }).done(function(data){
    customfield_edit(data);
    $("#create-project").modal('hide');
    $("#create-project").find(':input').val('');
    $("#create-project").find(':input').removeClass('has-error');
    //toast;
    toastr.success(data.name+' has been edited');
    tableData.ajax.reload();
    $("#edit-project").modal('hide');
  }).fail( function(xhr, textStatus, errorThrown, data) {
    tableData.ajax.reload();
    // toast;
    toastr.warning(data.name+' has not been edited');
  });
});

// Empty fields before show modal
$('#btn-create-project').on('click', function(){
  $("#create-project").find(':input').val('');
  $("#create-project").find(':select option[selected=selected]').html('');
  $("#create-project").find(':input').removeClass('has-error');
});

// Empty fields before show modal
$('.edit-project').on('click', function(){
  $("#edit-project").find(':input').val('');
  $("#edit-project").find('select option[selected=selected]').html('');
  $("#edit-project").find(':input').removeClass('has-error');
});

// Create custom fields
function customfield_create(id){
  var record_id = id;
  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/customfields/'+model
  }).done(function(data){

    $.each(data, function(i,id){
      if($('#'+'c'+data[i].id).hasClass('customfield-select')){
        id = $('#'+'c'+data[i].id).val();
        text =   $('#'+'c'+data[i].id+' option:selected').text();
        customfields = 'content='+id;
        customfields = customfields + '&addcontent='+text;
      }else{
        customfields = $('#'+'c'+data[i].id).serialize();
      }
      customfields = customfields + '&record_id='+record_id;
      customfields = customfields + '&customfield_id='+data[i].id;

      // Create new record
      $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/customfield_values',
        data:customfields
      }).done(function(data){
      });
    });
  });
};

// Fill custom fields before edit
function customfield_show(id){
  $("#edit-project").find('.customfield').val('');
  $("#edit-project").find('select option[selected]').html('');
  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/customfield_values/'+id
  }).done(function(data){
    $.each(data, function(i,id,customfield_id,content,addcontent){
      if(data[i].addcontent != null){
        $('#'+'e'+data[i].customfield_id+" option[value="+data[i].content+"]").remove();
        $('#'+'e'+data[i].customfield_id).append('<option selected="selected" value="'+data[i].content+'">'+data[i].addcontent+'</option>');
      }
      $('#'+'e'+data[i].customfield_id).val(data[i].content);
      $('#'+'e'+data[i].customfield_id).attr('data-id',data[i].id);
    });
  });
}

// Edit custom fields
function customfield_edit(id){
  var record_id = id;
  $.ajax({
    dataType: 'json',
    type:'GET',
    url: '/customfields/'+model
  }).done(function(data){

    $.each(data, function(i,id){
      if($('#'+'e'+data[i].id).hasClass('customfield-select')){
        id = $('#'+'e'+data[i].id+' option:selected').val();
        text =   $('#'+'e'+data[i].id+' option:selected').text();
        customfields = 'content='+id;
        customfields = customfields + '&addcontent='+text;
      }else{
        customfields = $('#'+'e'+data[i].id).serialize();
      }
      customfields = customfields + '&record_id='+record_id;
      customfields = customfields + '&customfield_id='+data[i].id;
      customfield_value_id = $('#edit-form').find('#'+'e'+data[i].id).attr('data-id');

      // // First delete record
      if(customfield_value_id){
        $.ajax({
          dataType: 'json',
          type:'DELETE',
          url: '/customfield_values/'+customfield_value_id,
        }).done(function(data){
        });
      }

      // Then create new record
      $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/customfield_values',
        data:customfields
      }).done(function(data){
      });
    });
  });
};
</script>
@stop
