@if(Request()->path() != 'user/profile')
<div class="profile">
  <img class="img img-thumbnail" src="{{url('uploads/photo',Auth::user()->photo)}}" alt="">
</div><br>
@endif
<div class="list-group profile-menu">
  @if(Request()->path() == 'user/profile')
  <a class="list-group-item active" href="{{url('user/profile')}}">
    <span class="glyphicon glyphicon-user"></span>
    Mijn profiel</a>
  @else
  <a class="list-group-item" href="{{url('user/profile')}}">
    <span class="glyphicon glyphicon-user"></span>
    Mijn profiel</a>
  @endif

  @if(Request()->path() == 'user/responses')
  <a class="list-group-item active" href="{{route('responses')}}">
    <span class="glyphicon glyphicon-comment"></span>
    Mijn reacties</a>
  @else
  <a class="list-group-item" href="{{route('responses')}}">
    <span class="glyphicon glyphicon-comment"></span>
    Mijn reacties</a>
  @endif

  @if(Request()->path() == 'user/ad')
  <a class="list-group-item active" href="{{url('user/ad')}}">
    <span class="glyphicon glyphicon-list-alt"></span>
    Mijn advertenties</a>
  @else
  <a class="list-group-item" href="{{url('user/ad')}}">
    <span class="glyphicon glyphicon-list-alt"></span>
    Mijn advertenties</a>
  @endif
<br>
  <a href="{{route('jobrequest')}}" class="list-group-item">
    <span class="glyphicon glyphicon-bullhorn"></span>
    Plaats mijn oproep</a>
  <a href="{{route('jobopening')}}" class="list-group-item">
    <span class="glyphicon glyphicon-ok-circle"></span>
    Plaats een vacature</a>
</div>


  <div class="list-group">
    <a href="#" class="list-group-item clearfix">
      <span class="glyphicon glyphicon-file"></span>
      Lorem ips
    </a>
  </div>
</div>
