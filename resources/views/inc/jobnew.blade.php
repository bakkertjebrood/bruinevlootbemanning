<form  id="newjob" enctype="multipart/form-data" action="{{url('user/ad')}}" method="post">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><small><a href="{{url('/')}}">@lang('labels.welcome')</a></small></li>
      <li class="breadcrumb-item active" aria-current="page">
        @lang('labels.newad')
      </li>
    </ol>

    <div>
      @if($ad_type == 1)
      <h1>@lang('labels.newopening')</h1>
      @else
      <h1>@lang('labels.newrequest')</h1>
      @endif
      <hr>
    </div>

    <div class="col-lg-9">

      @include('flash::message')

      {{ csrf_field() }}
      <input type="hidden" name="type" value="{{$ad_type}}">
      <div class="form-group">
        @if($ad_type == 1)
        <label for="name">@lang('labels.title')</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="@lang('labels.titleopeningexample')" required="true">
        @else
        <label for="name">@lang('labels.title')</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="@lang('labels.titlerequestexample')" required="true">
        @endif
      </div>

      <div class="form-group">
        <label class="control-label" for="title">@lang('labels.photo')</label>
        <div class="validation-errors"></div>
        <input id="newad_file" type="file" name="photo" class="form-control"/>
      </div>

      <div class="form-group">
        <label for="name">
          @lang('labels.harbor')
        </label>
        <!-- <input type="text" class="form-control" id="homeport" name="homeport" value="" placeholder="Enkhuizen" required="true"> -->
        <select class="select-places" id="selectPlace" name="homeport" required="true">

        </select>
      </div>

      <div class="form-group">
        <label for="title">
          @if($ad_type == 1)
          @lang('labels.neededskills')
          @else
          @lang('labels.haveskills')
          @endif
        </label>
        <select multiple="true" class="select-skills" name="skills[]">
        </select>
      </div>

      <div class="form-group">
        <label for="title">@lang('labels.categories')</label>
        <select multiple="true" class="select-categories" name="categories[]" required="true">
        </select>
      </div>

      <div class="form-group">
        <label for="daterange">
          @if($ad_type == 1)
          @lang('labels.whenneeded')
          @else
          @lang('labels.whenavailable')
          @endif
        </label>
        <div class="input-group input-daterange" id="daterange">
          <input type="text" class="form-control datepicker" name="startdate" value="" placeholder="01-01-2018" required="true">
          <div class="input-group-addon">@lang('labels.until')</div>
          <input type="text" class="form-control datepicker" name="enddate" value="" placeholder="01-01-2019" required="true">
        </div>
      </div>

      <div class="form-group">
        @if($ad_type == 1)
        <label for="name">@lang('labels.description')</label>
        <textarea type="text" rows="7" class="form-control" name="description" value="" placeholder="@lang('labels.describeneeds')" required="true"></textarea>
        @else
        <label for="name">@lang('labels.description')</label>
        <textarea type="text" rows="7" class="form-control" name="description" value="" placeholder="@lang('labels.describeyourself')" required="true"></textarea>
        @endif
      </div>

      @if($ad_type == 2)
      <div class="form-group">
        <label for="name">@lang('labels.experience')</label>
        <textarea type="text" rows="7" class="form-control" name="experience" value="" placeholder="@lang('labels.describeexperience')" required="true"></textarea>
      </div>
      @endif

    </div>

    <div class="col-lg-3">
      @if($ad_type == 1)
      <img id="newad_image" class="img img-thumbnail" src="{{url('/uploads/photo','default-photo.jpg')}}" alt="">
      @else
      <img id="newad_image" class="img img-thumbnail" src="{{url('/uploads/photo',Auth::user()->photo)}}" alt="">
      @endif
      <br>

      <div class="list-group notice-inverse">
              <br>
        <button type="submit" class="list-group-item list-group-item-primary" href="#" id="save">@lang('labels.save')</button>
      </div>
    </div>

  </div>
</form>


@section('scripts')
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#newad_image').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#newad_image").css( 'cursor', 'pointer' );
$("#newad_image").click(function() {
  $("#newad_file").click();
});

$("#newad_file").change(function() {
  readURL(this);
});



</script>
@stop
