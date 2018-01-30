<div class="hidden-xs">
@if(Request()->path() != 'user/profile')
<div class="profile">
  <img class="img img-thumbnail" src="{{url('uploads/photo',Auth::user()->photo)}}" alt="">
</div><br>
@endif
<div class="list-group profile-menu">
  @if(Request()->path() == 'user/profile')
  <a class="list-group-item active" href="{{url('user/profile')}}">
    <span class="glyphicon glyphicon-user"></span>
    @lang('labels.myprofile')</a>
  @else
  <a class="list-group-item" href="{{url('user/profile')}}">
    <span class="glyphicon glyphicon-user"></span>
    @lang('labels.myprofile') </a>
  @endif

  @if(Request()->path() == 'user/responses')
  <a class="list-group-item active" href="{{route('responses')}}">
    <span class="glyphicon glyphicon-comment"></span>
    @lang('labels.myresponses')</a>
  @else
  <a class="list-group-item" href="{{route('responses')}}">
    <span class="glyphicon glyphicon-comment"></span>
    @lang('labels.myresponses')</a>
  @endif

  @if(Request()->path() == 'user/ad')
  <a class="list-group-item active" href="{{url('user/ad')}}">
    <span class="glyphicon glyphicon-list-alt"></span>
    @lang('labels.myads')</a>
  @else
  <a class="list-group-item" href="{{url('user/ad')}}">
    <span class="glyphicon glyphicon-list-alt"></span>
    @lang('labels.myads')</a>
  @endif
<br>
  <a href="{{route('jobrequest')}}" class="list-group-item">
    <span class="glyphicon glyphicon-bullhorn"></span>
    @lang('labels.placecall')</a>
  <a href="{{route('jobopening')}}" class="list-group-item">
    <span class="glyphicon glyphicon-ok-circle"></span>
    @lang('labels.placevacancy')</a>
</div>

</div>
