@extends('adminlte::page')

@section('title', 'Planning')

@section('content_header')
<h1>Planning</h1>
<ol class="breadcrumb">
        <li><a id="searchresults" href="#">{{Session::get('planningitems_year')}}</a></li>
        <li class="active">Dashboard</li>
      </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-lg-4">
      <div class="box box-solid box-primary" width="100%">
        <div class="box-header with-border">
          <h3 class="box-title">Search</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form  id="search-form" class="" action="index.html" method="get">
            <div class="form-group" >
              <!-- <label for="username">Username</label> -->
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-user"></i>
                </div>
                <select width="100%" multiple="multiple" type="text" name="username" id="s_username" class="form-control select-users" value="" placeholder="Search Username">
                  @if(Session::has('planningitems_users'))
                  @foreach(Session::get('planningitems_users') as $user)
                  <option value="{{$user->id}}" selected="selected">{{$user->name}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-group"></i>
                </div>
                <select width="100%" multiple="multiple" type="text" name="department" id="s_department" class="form-control select-departments" value="" >
                  @if(Session::has('planningitems_departments'))
                  @foreach(Session::get('planningitems_departments') as $department)
                  <option value="{{$department}}" selected="selected">{{$department}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="s_year" name="year" value="{{Session::get('planningitems_year')}}" class="form-control pull-right dateyear"   placeholder="Enter year" data-error="Please enter year." required />
              </div>
            </div>

            <div class="form-group">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <select width="100%" multiple="multiple" type="text" name="month" id="s_month" class="form-control select-months" value=""  ></select>
              </div>
            </div>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-tasks"></i>
              </div>
              <select width="100%" multiple="multiple" type="text" id="s_project"  name="project_id" class="form-control select-projects" data-error="Please enter title." /></select>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right" name="button">Search</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div  class="box box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">Calculate capacity</h4>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>        </div>
          </div>
          <div class="box-body">
            <table id="calculate_capacity-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <th>Name</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mrt</th>
                <th>Apr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Aug</th>
                <th>Sep</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>
              </thead>

            </table>
          </div>
          <div class="box-footer">
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-lg-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4 class="box-title">Planning</h4>
            <div class="box-tools pull-right">
              <button type="button" data-target="#create-planningitem" data-toggle="modal" class="btn btn-primary btn-xs" name="button">Create new Planningitem</button>
            </div>
          </div>
          <div class="box-body">
            <table id="planning-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <th>ID</th>
                <th></th>
                <th>Employee</th>
                <th>Year</th>
                <th>Month</th>
                <th>Days</th>
                <th>Remark</th>
                <th width="110px">Action</th>
              </thead>

            </table>
          </div>
          <div class="box-footer">
          </div>
        </div>
      </div>
    </div>

  <!-- Create planningitem -->
  <div class="modal fade" id="create-planningitem" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Create new planningitem</h4>
        </div>
        <div class="modal-body">
          <form id="create-form-planningitem" data-toggle="validator" action="/planningitems/data" method="post">
            <!-- <input type="hidden" id="image_edit_input" name="image" value=""> -->

            <div class="info-box">
              <!-- Apply any bg-* class to to the icon to color it -->
              <span id="inform_availability" class="info-box-icon bg-blue"><i class="fa fa-bar-chart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Availability:</span>
                <span class="info-box-number"><i>Not enough data to calculate...</i></span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <div class="form-group">
              <label class="control-label" for="title">User</label>
              <select type="text" id="user_id" style="width:100%" name="user_id" class="form-control select-users calculate" data-error="Please enter title." required /></select>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label" for="title">Year</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input multiple="multiple" type="text" id="year" name="year" class="form-control pull-right dateyear calculate"  data-error="Please enter year." required />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="title">Month</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="month" name="month" class="form-control calculate datemonth" data-error="Please enter month." required />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="title">Project</label>
              <select type="text" id="project_id" style="width:100%" name="project_id" class="form-control select-projects" data-error="Please enter title." required /></select>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label" for="title">Days</label>
              <input type="text" id="days" name="days" value="0" class="form-control calculate" data-error="Please enter title." required />
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label" for="title">Remark</label>
              <textarea type="text" id="name" name="name" class="form-control" data-error="Please enter title." required /></textarea>
              <div class="help-block with-errors"></div>
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

  // Planningitems datatable
  var planningData = $('#planning-table').DataTable({
    processing: true,
    serverSide: true,
    drawCallback: function(settings){
      var api = this.api();
      // Initialize custom control
      initDatepicker(api.table());
      initSelect(api.table());
    },
    ajax: {
      url:'/planningitems/data',
      data: function (d) {
        d.user_ids = $('#s_username').select2('val');
        d.year = $('#s_year').val();
        d.departments = $('#s_department').select2('val');
        d.projects = $('#s_project').select2('val');
        d.months = $('#s_month').select2('val');
      }},
      columns: [
        {data: 'id', name: 'id'},
        {data: 'project_name', name: 'project_name'},
        {data: 'user_name', name: 'user_name'},
        {data: 'year', name: 'year'},
        {data: 'month', name: 'month'},
        {data: 'days', name: 'days'},
        {data: 'name', name: 'name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ],
      "columnDefs": [
        {
          "targets": [ 1,0,3 ],
          "visible": false,
          "searchable": false
        }],
        rowGroup: {
          dataSrc: 'project_name'
        },
        order: [[1, 'asc'],[4, 'asc']],
      });

      // calculate_capacity datatable
      var calculate_capacityData = $('#calculate_capacity-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url:'/planningitems/calculate_capacity',
          data: function (d) {
            d.user_ids = $('#s_username').select2('val');
            d.year = $('#s_year').val();
            d.departments = $('#s_department').select2('val');
            d.projects = $('#s_project').select2('val');
            d.months = $('#s_month').select2('val');
          }},
          columns: [
            {data: 'name', name: 'name'},
            {data: 'Jan', name: 'Jan'},
            {data: 'Feb', name: 'Feb'},
            {data: 'Mar', name: 'Mar'},
            {data: 'Apr', name: 'Apr'},
            {data: 'May', name: 'May'},
            {data: 'Jun', name: 'Jun'},
            {data: 'Jul', name: 'Jul'},
            {data: 'Aug', name: 'Aug'},
            {data: 'Sep', name: 'Sep'},
            {data: 'Oct', name: 'Oct'},
            {data: 'Nov', name: 'Nov'},
            {data: 'Dec', name: 'Dec'}
          ]
        }

      );

      $('#search-form').submit(function(e) {
        calculate_capacityData.draw();
        planningData.draw();
        e.preventDefault();
        year = $('#search-form').find('#s_year').val();
        month = $('#search-form').find('#s_month').val();
        department = $('#search-form').find('#s_department').val();
        project_id = $('#search-form').find('#s_project_id').val();
        username = $('#search-form').find('#s_username').val();

        $.ajax({
          type: "POST",
          url: "{{ url('planningitems/sessions') }}",
          data:{year:year,month:month,department:department,project_id:project_id,username:username}
        }).done(function(data){
            $('#searchresults').html(data.department);
        });

      });

      // Create planningitem
      $("#create-form-planningitem").submit(function(e){
        e.preventDefault();
        var form_action = $("#create-planningitem").find("form").attr("action");
        var content = $(this).serialize();

        $.ajax({
          dataType: 'json',
          type:'POST',
          url: '/planningitems/data',
          data:content
        }).done(function(data){
          $("#create-planningitem").modal('hide');
          $("#create-planningitem").find(':input').val('');
          $("#create-planningitem").find(':input').removeClass('has-error');
          toastr.success('The planning item has been created','Done!');
          planningData.ajax.reload();
          calculate_capacityData.ajax.reload();
        }).fail( function(xhr, textStatus, errorThrown) {
          planningData.ajax.reload();
          // toast;
          toastr.warning('Warning','Something went wrong');
        });
      });

      // Delete planningitem
      $('body').on('click','.delete-planningitem',function(){
        var id = $(this).attr('data-id');

        $.ajax({
          dataType: 'json',
          type:'DELETE',
          url: '/planningitems/data/'+id,
          //data:content
        }).done(function(data){
          toastr.success('The planning item has been deleted','Done');
          planningData.ajax.reload();
          calculate_capacityData.ajax.reload();
        }).fail( function(xhr, textStatus, errorThrown) {
          planningData.ajax.reload();
          toastr.success('The value has been deleted','Done');
        });
      });

      $('#create-planningitem').find('#month').on('change', function(){
        year = $('#year').val();
        month = $('#month').val();
        user_id = $('#user_id').val();

        if(year != '' && month != '' && user_id != ''){
          calculate_capacity_onthefly();
        }

      });

      $('#create-planningitem').find('#days').on('keyup', function(){
        year = $('#year').val();
        month = $('#month').val();
        user_id = $('#user_id').val();

        if(year != '' && month != '' && user_id != ''){
          calculate_capacity_onthefly();
        }

      });

        function calculate_capacity_onthefly(){
        var form_action = $("#create-planningitem").find("form").attr("action");
        var content = $('#create-form-planningitem').serialize();

        $.ajax({
          dataType: 'json',
          type:'GET',
          url: '/planningitems/calculate_capacity_onthefly',
          data:content
        }).done(function(data){
          result = data;
          days = parseInt($('#days').val());

          if(days == ''){
            days = 0
          }
          withmargin = result[0].withmargin;
          withoutmargin = result[0].withoutmargin;
          margin = result[0].margin;

          withmargin = parseInt(withmargin - days);
          withoutmargin = parseInt(withoutmargin - days);

          $('.info-box-number').html(parseInt(withmargin)+' days with '+parseInt(margin)+'% margin<br>'+parseInt(withoutmargin)+' days without margin');
          if(withmargin > 0){
            $('#inform_availability').removeClass('bg-blue').addClass('bg-green').fadeIn(500);
            $('#inform_availability').find('i').removeClass('fa-thumbs-down').addClass('fa-thumbs-up').fadeIn(500);
          }else if (withmargin < 0) {
            $('#inform_availability').removeClass('bg-green').addClass('bg-red').fadeIn(500);
            $('#inform_availability').find('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-down').fadeIn(500);
          }

        }).fail( function(xhr, textStatus, errorThrown) {

        });
      }

      /* Edit availability from grid */
      $('body').on('change','.editable',function(e){
        e.preventDefault();
        var id = $(this).closest('tr').find('.delete-planningitem').attr('data-id');
        var content = $(this).serialize();

        $.ajax({
          dataType: 'json',
          type:'PUT',
          url: '/planningitems/data/'+id,
          data:content
        }).done(function(data){
          toastr.success('The value has been edited','Done');
          planningData.ajax.reload();
          calculate_capacityData.ajax.reload();
          $("#edit-availability").modal('hide');
        }).fail( function(xhr, textStatus, errorThrown) {
          planningData.ajax.reload();
          // toast;
          toastr.warning('Warning',xhr, textStatus, errorThrown);
        });
      });
      </script>
      @stop
