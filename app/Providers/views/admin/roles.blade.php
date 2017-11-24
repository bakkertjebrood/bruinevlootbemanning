  @extends('adminlte::page')

  @section('title', trans('adminlte::adminlte.roles'))

  @section('content_header')

  @stop

  @section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{trans('adminlte::adminlte.roles')}}</h3>
      <div class="box-tools pull-right">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
        <button type="button" data-target="#create-role" data-toggle="modal" class="btn btn-primary btn-xs" name="button">{{trans('adminlte::adminlte.create_role')}}</button>
      </div>
    </div>
    <div class="box-body">
      <table id="roles-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <th>ID</th>
          <th>{{trans('adminlte::adminlte.name')}}</th>
          <th>{{trans('adminlte::adminlte.description')}}</th>
          <th width="160px">{{trans('adminlte::adminlte.action')}}</th>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div class="box-footer">

    </div>
  </div>

  <!-- Create role -->
  <div class="modal fade" id="create-role" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">{{trans('adminlte::adminlte.create_role')}}</h4>
        </div>
        <div class="modal-body">
          <form id="create-form" data-toggle="validator" action="/roles/data" method="post">

            <div class="form-group">
              <label class="control-label" for="title">{{trans('adminlte::adminlte.name')}}</label>
              <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label" for="title">{{trans('adminlte::adminlte.description')}}</label>
              <input type="text" id="description" name="description" class="form-control" data-error="Please enter title." required />
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

  <!-- Edit role -->
  <div class="modal fade" id="edit-role" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">{{trans('adminlte::adminlte.edit_role')}}</h4>
        </div>
        <div class="modal-body">
          <form id="edit-form" data-toggle="validator" action="/roles/data" method="post">
            <input type="hidden" id="id" name="id" value="">

            <div class="form-group">
              <label class="control-label" for="title">{{trans('adminlte::adminlte.name')}}</label>
              <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
              <div class="help-block with-errors"></div>
            </div>


            <div class="form-group">
              <label class="control-label" for="title">{{trans('adminlte::adminlte.description')}}</label>
              <input type="text" id="description" name="description" class="form-control" data-error="Please enter title." required />
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

  var tableData = $('#roles-table').DataTable({
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
    ajax: '/roles/data',
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
      {data: 'description', name: 'description'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  });

  // Create role
  $("#create-form").submit(function(e){
    e.preventDefault();
    var form_action = $("#create-role").find("form").attr("action");
    var content = $(this).serialize();

    $.ajax({
      dataType: 'json',
      type:'POST',
      url: '/roles/data',
      data:content
    }).done(function(data){
      $("#create-role").modal('hide');
      $("#create-role").find(':input').val('');
      $("#create-role").find(':input').removeClass('has-error');
      //toast;
      toastr.success('{{trans("adminlte::adminlte.created_role")}}');
      tableData.ajax.reload();
    }).fail( function(xhr, textStatus, errorThrown) {
      tableData.ajax.reload();
      // toast;
      toastr.warning('{{trans("adminlte::adminlte.error")}}');
    });
  });

  // Delete role
  $('body').on('click','.delete-role',function(){
    var id = $(this).attr('data-id');

    $.ajax({
      dataType: 'json',
      type:'DELETE',
      url: '/roles/data/'+id,
      //data:content
    }).done(function(data){
            console.log(data);
      toastr.success('{{trans("adminlte::adminlte.deleted_role")}}');
      tableData.ajax.reload();
    }).fail( function(data) {
      tableData.ajax.reload();
      console.log(data);
      toastr.warning(data.responseText);
    });
  });

  // Get role data before editing
  $('body').on('click','.edit-role', function(){
    var id = $(this).attr('data-id');

    $.ajax({
      dataType: 'json',
      type:'GET',
      url: '/roles/data/'+id,
    }).done(function(data){
      $('#edit-role').find('#name').val(data.name);
      $('#edit-role').find('#description').val(data.description);
      $('#edit-role').find('#id').val(data.id);

    });
  });

  /* Edit role */
  $("#edit-form").submit(function(e){
    e.preventDefault();
    // var form_action = $("#edit-role").find("form").attr("action");
    var id = $('#edit-role').find('#id').val();
    var content = $(this).serialize();

    $.ajax({
      dataType: 'json',
      type:'PUT',
      url: '/roles/data/'+id,
      data:content
    }).done(function(data){
      $("#create-role").modal('hide');
      $("#create-role").find(':input').val('');
      $("#create-role").find(':input').removeClass('has-error');
      //toast;
      toastr.success('{{trans("adminlte::adminlte.updated_role")}}');
      tableData.ajax.reload();
      $("#edit-role").modal('hide');
    }).fail( function(data) {
      tableData.ajax.reload();
      toastr.warning('{{trans("adminlte::adminlte.error")}}');
    });
  });
  </script>
  @stop
