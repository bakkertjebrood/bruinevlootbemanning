@extends('adminlte::page')

@section('title', trans('adminlte::adminlte.settings'))

@section('content_header')
    <h1>{{trans('adminlte::adminlte.settings')}}</h1>
@stop

@section('content')
<div class="row">
<div class="col-lg-12">
  <div class="box box-primary">
    <form class="" action="{{url('admin/settings')}}" method="post">
      {{ csrf_field() }}
    <div class="box-body">
      <table class="table table-hover table-striped">
          <thead>
            <th>{{trans('adminlte::adminlte.setting')}}</th>
            <th>{{trans('adminlte::adminlte.value')}}</th>
          </thead>
          <tbody>

              <tr>
                <td>{{trans('adminlte::adminlte.app_language')}}</td>
                <td>
                  <select type="text" name="language" class="form-control" id="" placeholder="">
                    @if($language == 'en')
                    <option value="en" selected="selected">{{trans('adminlte::adminlte.english')}}</option>
                    <option value="nl">{{trans('adminlte::adminlte.dutch')}}</option>
                    @elseif($language == 'nl')
                    <option value="en">{{trans('adminlte::adminlte.english')}}</option>
                    <option value="nl" selected="selected">{{trans('adminlte::adminlte.dutch')}}</option>
                    @endif
                  </select>
                </td>
              </tr>

              <tr>
                <td>fdfd</td>
                <td>fdfd</td>

              </tr>

              <tr>
                <td>fdfd</td>
                <td>fdfd</td>
              </tr>

            </form>
          </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
      <button type="submit" class="btn btn-primary pull-right" name="setsettings">{{trans('adminlte::adminlte.save')}}</button>
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



</script>
@stop
