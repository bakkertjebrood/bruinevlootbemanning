@if(Request()->path() != 'user/profile')
<div class="profile">
  <img class="img img-thumbnail" src="{{url('uploads/photo',Auth::user()->photo)}}" alt="">
</div><br>
@endif
<div class="list-group">
  @if(Request()->path() == 'user/profile')
  <a class="list-group-item active" href="{{url('user/profile')}}">Mijn profiel</a>
  @else
  <a class="list-group-item" href="{{url('user/profile')}}">Mijn profiel</a>
  @endif

  @if(Request()->path() == 'user/responses')
  <a class="list-group-item active" href="{{route('responses')}}">Mijn reacties</a>
  @else
  <a class="list-group-item" href="{{route('responses')}}">Mijn reacties</a>
  @endif

  @if(Request()->path() == 'user/ad')
  <a class="list-group-item active" href="{{url('user/ad')}}">Mijn advertenties</a>
  @else
  <a class="list-group-item" href="{{url('user/ad')}}">Mijn advertenties</a>
  @endif
</div>


<div class="list-group ">
  <a href="{{route('jobrequest')}}" class="list-group-item">Plaats mijn oproep</a>
  <a href="{{route('jobopening')}}" class="list-group-item">Plaats een vacature</a>
</div>
