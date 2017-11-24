@extends('adminlte::page')

@section('title', 'Employees')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="box box-solid box-primary" width="100%">
      <div class="box-header with-border">
        <h3 class="box-title">Search</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <form  id="search-form" class="" action="" method="get">
          <div class="form-group" >
            <label for="username">Username</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <select width="100%" multiple="multiple" type="text" name="username" id="s_username" class="form-control select-users" value="" placeholder="Search Username">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="username">Department</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-group"></i>
              </div>
              <select width="100%" multiple="multiple" type="text" name="department" id="s_department" class="form-control select-departments" value="" placeholder="Search department"></select>
            </div>
          </div>

        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" name="button">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">{{ trans('adminlte::adminlte.employees') }}</h3>
    <div class="box-tools pull-right">
      <button type="button" data-target="#create-user" id="create-user-btn" data-toggle="modal" class="btn btn-primary btn-xs" name="button">{{ trans('adminlte::adminlte.create_new_employee') }}</button>
    </div>
  </div>
  <div class="box-body">
    <table id="users-table" class="table table-striped" width="100%">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department(s)</th>
        <th width="110px">Action</th>
      </thead>

    </table>
  </div>
  <div class="box-footer">

  </div>
</div>

<!-- Create user -->
<div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Create new employee</h4>
      </div>
      <div class="modal-body">

        <div class="row middle">
          <div class="middle" style="width:100%;text-align:center">
            <div id="image_create_output" class="middle circle-img-l img-circle">
              <img src="css/img/default_user.png" id="image_create_default" alt="">
            </div>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label" for="title">Photo</label>
          <div class="validation-errors"></div>
          <form class="form-horizontal" id="image_create_form" enctype="multipart/form-data" method="post" action="{{ url('uploads/image') }}" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="file" class="form-control" name="image" id="image_create_upload" />
          </form>
        </div>

        <div class="panel-group" id="accordion_c">
          <div class="panel panel-default">
            <div data-toggle="collapse" data-parent="#accordion_c" href="#collapse_c1" class="panel-heading">
              <h4 class="panel-title">
                <a>Basic user info</a>
              </h4>
            </div>
            <div id="collapse_c1" class="panel-collapse collapse in">
              <div class="panel-body">

                <form id="create-form" data-toggle="validator" action="/users/data" method="post">
                  <input type="hidden" id="image_create_input" name="photo" value="">
                  <div class="form-group">
                    <label class="control-label" for="title">Username</label>
                    <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="title">First name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="title">Last name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="title">Email</label>
                    <input type="text" id="email" name="email" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="title">Password</label>
                    <input type="password" autocomplete="new-password" id="password" name="password" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="username">Roles</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-check-circle-o"></i>
                      </div>
                      <select style="width:100%" multiple="multiple" type="text" name="roles" id="roles" class="form-control select-roles select2" value="" placeholder="Select roles">
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username">Departments</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-users"></i>
                      </div>
                      <select style="width:100%" multiple="multiple" type="text" name="departments" id="departments" class="form-control select-departments select2" value="" placeholder="Select departments">
                      </select>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>

        </div>
        <!-- <div class="panel panel-default">
          <div data-toggle="collapse" data-parent="#accordion_c" href="#collapse_c2" class="panel-heading">
            <h4 class="panel-title">
              <a>Extended information</a>
            </h4>
          </div>
          <div id="collapse_c2" class="panel-collapse collapse">
            <div class="panel-body">

            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>

<!-- Edit user -->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Edit employee</h4>
      </div>
      <div class="modal-body">

        <div class="row middle">
          <div class="middle" style="width:100%;text-align:center">
            <div id="image_edit_output" class="middle circle-img-l img-circle">
              <img src="css/img/default_user.png" id="image_edit_default" alt="">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label" for="title">Photo</label>
          <div class="validation-errors"></div>
          <form class="form-horizontal" id="image_edit_form" enctype="multipart/form-data" method="post" action="{{ url('uploads/image') }}" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="file" class="form-control" name="image" id="image_edit_upload" />
          </form>
        </div>

        <div class="panel-group" id="accordion_e">
          <div class="panel panel-default">
            <div data-toggle="collapse" data-parent="#accordion_e" href="#collapse_e1" class="panel-heading">
              <h4 class="panel-title">
                <a>Basic user info</a>
              </h4>
            </div>
            <div id="collapse_e1" class="panel-collapse collapse in">
              <div class="panel-body">
                <form id="edit-form" data-toggle="validator" action="/users/data" method="post">
                  <input type="hidden" id="id" name="id" value="">
                  <input type="hidden" id="photo" name="photo" value="">
                  <div class="form-group">
                    <label class="control-label" for="title">Username</label>
                    <input type="text" id="name" name="name" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="title">First name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="title">Last name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="title">Email</label>
                    <input type="text" id="email" name="email" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                  </div>

                  <div class="form-group">
                    <label for="username">Roles</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-check-circle-o"></i>
                      </div>
                      <select  style="width:100%" multiple="multiple" type="text" name="roles" id="roles" class="fullwidth form-control select-roles " value="" placeholder="Select roles">
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username">Departments</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-users"></i>
                      </div>
                      <select style="width:100%" multiple="multiple" type="text" name="departments" id="departments" class="fullwidth form-control select-departments " value="" placeholder="Select departments">
                      </select>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>

            </div>
          </div>
        </div>
        <!-- <div class="panel panel-default">
          <div data-toggle="collapse" data-parent="#accordion_e" href="#collapse_e2" class="panel-heading">
            <h4 class="panel-title">
              <a>Extended information</a>
            </h4>
          </div>
          <div id="collapse_e2" class="panel-collapse collapse">
            <div class="panel-body">
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
@stop

@section('custom_scripts')
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  error: function (jqXHR, textStatus, errorThrown) {
    if (event.status == 403) {
      toastr.error("Sorry, your session has expired.", "Please login again to continue");
      window.location.href ="/login";
    }
    else {
      toastr.error("An error occurred: " + textStatus, "nError: " + errorThrown);
    }
  }

});

initSelect();
initDatepicker();

var tableData = $('#users-table').DataTable({
  processing: true,
  serverSide: true,

  ajax: {
    url: '/users/data',
    data: function (d) {
      d.name = $('#s_username').select2('val');
      d.department = $('#s_department').select2('val');
    }},

    columnDefs:[
      {
        'targets': [0,3],
        'visible': false,
        'searchable':false
      }
    ],
    columns: [
      {data: 'id', name: 'id'},
      {data: 'name', name: 'name'},
      {data: 'email', name: 'email'},
      {data: 'department', name: 'department'},
      {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    group: [[3]],
    order: [[3, 'asc']],
    rowGroup: {
      dataSrc: ['department']
    },
  });

  // Create user
  $("#create-form").submit(function(e){
    e.preventDefault();
    var form_action = $("#create-user").find("form").attr("action");
    var content = $("#create-form").serialize();

    $.ajax({
      dataType: 'json',
      type:'POST',
      url: '/users/data',
      data:content
    }).done(function(data){
      $("#create-user").modal('hide');
      $("#create-user").find(':input').not('select').val('');
      $("#create-user").find(':input').removeClass('has-error');
      toastr.success('The user has been created');
      tableData.ajax.reload();

      // Insert or delete roles for the user
      var user_id = data.id;
      role_id = $("#create-user").find('.select-roles').val();

      $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/role_user/data',
        data:{user_id:user_id,role_id:role_id}
      }).done(function(data){
        // console.log(data);
      });

      // Insert or delete departments for the user
      department_id = $("#create-user").find('.select-departments').val();
      // console.log(department_id);

      $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/department_user/data',
        data:{user_id:user_id,department_id:department_id}
      }).done(function(data){
        // console.log(data);
      });
    }).fail( function(xhr, textStatus, errorThrown) {
      tableData.ajax.reload();
      // toast;
      toastr.warning('Warning','errorThrown');
    });
  });

  // Delete user
  $('body').on('click','.delete-user',function(){
    var id = $(this).attr('data-id');

    $.ajax({
      dataType: 'json',
      type:'DELETE',
      url: '/users/data/'+id,
    }).done(function(data){
      toastr.success('The employee has been deleted');
      tableData.ajax.reload();
    }).fail( function(xhr, textStatus, errorThrown) {
      tableData.ajax.reload();
      // toast;
      toastr.warning('Warning');
    });
  });

  // Get user data before editing
  $('body').on('click','.edit-user', function(){
    var id = $(this).attr('data-id');

    $.ajax({
      dataType: 'json',
      type:'GET',
      url: '/users/data/'+id,
    }).done(function(data){
      $('#edit-user').find('#name').val(data.name);
      $('#edit-user').find('#email').val(data.email);
      $('#edit-user').find('#id').val(data.id);
      $('#edit-user').find('#firstname').val(data.firstname);
      $('#edit-user').find('#lastname').val(data.lastname);
      $('#edit-user').find('#user-span').html(data.firstname+' '+data.lastname);
      if(data.photo){
        $('#image_edit_default').attr('src',data.photo);
        $('#edit-user').find('#photo').val(data.photo);
      }
    }).fail(function(){
    });

    // Get roles for select
    $.ajax({
      dataType: 'json',
      type:'GET',
      url: '/role_user/data/'+id,
    }).done(function(data){
      var options = '';
      $.each(data, function (n, name, id){
        options += '<option value="'+data[n].id+'" selected="selected">'+data[n].name+'</option>'
      });
      $('#edit-user').find('.select-roles').html(options);
    });

    // Select roles changed
    $("#edit-user").find('.select-roles').on('change',function(e){
      role_id = $(this).val();
      user_id = id;
      $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/role_user/data',
        data:{user_id:user_id,role_id:role_id}
      }).done(function(data){
      });
    });

    // Get departments for select-roles
    $.ajax({
      dataType: 'json',
      type:'GET',
      url: '/department_user/data/'+id,
    }).done(function(data){
      var options = '';
      $.each(data, function (n, name, id){
        options += '<option value="'+data[n].id+'" selected="selected">'+data[n].name+'</option>'
      });
      $('#edit-user').find('.select-departments').html(options);
    });

    // Select departments changed
    $("#edit-user").find('.select-departments').on('change',function(e){
      department_id = $(this).val();
      user_id = id;
      $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/department_user/data',
        data:{user_id:user_id,department_id:department_id}
      }).done(function(data){
      });
    });
  });

  /* Edit user */
  $("#edit-form").submit(function(e){
    e.preventDefault();
    // var form_action = $("#edit-user").find("form").attr("action");
    var id = $('#edit-user').find('#id').val();
    var content = $(this).serialize();

    $.ajax({
      dataType: 'json',
      type:'PUT',
      url: '/users/data/'+id,
      data:content
    }).done(function(data){
      $("#create-user").modal('hide');
      $("#create-user").find(':input').val('');
      $("#create-user").find(':input').removeClass('has-error');
      //toast;
      toastr.success('The employee has been edited');
      tableData.ajax.reload();
      $("#edit-user").modal('hide');
    }).fail( function(xhr, textStatus, errorThrown) {
      tableData.ajax.reload();
      // toast;
      toastr.warning('Warning');
    });
  });

  //Image upload in create field
  $('#create-user-btn').click(function(){
    var options = {
      beforeSubmit:  showRequest,
      success:       showResponse,
      dataType: 'json'
    };
    $('#image_create_upload').change(function(){
      $('#image_create_form').ajaxForm(options).submit();

    });
    function showRequest(formData, jqForm, options) {
      //$(".validation-errors").hide().empty();
      $("#image_create_output").css('display','');
      return true;
    }
    function showResponse(response, statusText, xhr, $form)  {
      if(response.success == false)
      {
        var arr = response.errors;
        $.each(arr, function(index, value)
        {
          if (value.length != 0)
          {
            $(".validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
          }
        });
        $(".validation-errors").show();
      } else {
        $("#image_create_output").html("<img class='img img-circle' width='150px' height='150px' src='"+response.file+"' />");
        $("#image_create_default").css('display','none');
        $('#image_create_input').val(response.file);
      }
    }
  });
  //end Image upload in create field

  //Image upload in edit field
  $('body').on('click','.edit-user', function(){
    var options = {
      beforeSubmit:  showRequest,
      success:       showResponse,
      dataType: 'json'
    };
    $('#image_edit_upload').change(function(){
      $('#image_edit_form').ajaxForm(options).submit();

    });
    function showRequest(formData, jqForm, options) {
      //$(".validation-errors").hide().empty();
      $("#image_edit_output").css('display','');
      return true;
    }
    function showResponse(response, statusText, xhr, $form)  {
      if(response.success == false)
      {
        var arr = response.errors;
        $.each(arr, function(index, value)
        {
          if (value.length != 0)
          {
            $(".validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
          }
        });
        $(".validation-errors").show();
      } else {
        $("#image_edit_output").html("<img class='img img-circle' width='150px' height='150px' src='"+response.file+"' />");
        $("#image_edit_default").css('display','none');
        $('#image_edit_input').val(response.file);
        $('#edit-user').find('#photo').val(response.file);
      }
    }
  });

  $('#search-form').submit(function(e) {
    tableData.draw();
    e.preventDefault();
  });

  </script>
  @stop
