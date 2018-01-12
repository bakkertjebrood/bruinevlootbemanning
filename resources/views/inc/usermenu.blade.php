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
    <small>Mijn profiel</small></a>
  @else
  <a class="list-group-item" href="{{url('user/profile')}}">
    <span class="glyphicon glyphicon-user"></span>
    <small>Mijn profiel</small> </a>
  @endif

  @if(Request()->path() == 'user/responses')
  <a class="list-group-item active" href="{{route('responses')}}">
    <span class="glyphicon glyphicon-comment"></span>
    <small>Mijn reacties</small> </a>
  @else
  <a class="list-group-item" href="{{route('responses')}}">
    <span class="glyphicon glyphicon-comment"></span>
    <small>Mijn reacties</small></a>
  @endif

  @if(Request()->path() == 'user/ad')
  <a class="list-group-item active" href="{{url('user/ad')}}">
    <span class="glyphicon glyphicon-list-alt"></span>
    <small>Mijn advertenties</small> </a>
  @else
  <a class="list-group-item" href="{{url('user/ad')}}">
    <span class="glyphicon glyphicon-list-alt"></span>
    <small>Mijn advertenties</small></a>
  @endif
<br>
  <a href="{{route('jobrequest')}}" class="list-group-item">
    <span class="glyphicon glyphicon-bullhorn"></span>
    <small>Oproep plaatsen</small> </a>
  <a href="{{route('jobopening')}}" class="list-group-item">
    <span class="glyphicon glyphicon-ok-circle"></span>
    <small>Vacature plaatsen</small> </a>
</div>

</div>
