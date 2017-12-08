<!-- Search -->
<div class="search">

  <div class="list-group notice">
    <a href="{{route('jobrequest')}}" class="list-group-item">Plaats oproep</a>
    <a href="{{route('jobopening')}}" class="list-group-item">Plaats vacature</a>
  </div>

  <!-- Start / end -->
  <div class="daterange">
    <form class="" action="index.html" method="post">
      <label for="daterange">Datum bereik</label>
      <div class="input-group input-daterange" id="daterange">
        <input type="text" class="form-control datepicker" value="" placeholder="01-01-2018">
        <div class="input-group-addon">tot</div>
        <input type="text" class="form-control datepicker" value="" placeholder="01-01-2019">
      </div>
    </form>
  </div><br>

  <div class="list-group">
    <label for="search">Alles tonen</label>
    @if($ad_type == 1)
    <a href="{{route('jobrequests')}}" class="list-group-item ">Bemanning aanbod</a>
    <a href="{{route('jobopenings')}}" class="list-group-item active">Vacatures</a>
    @elseif($ad_type == 2)
    <a href="{{route('jobrequests')}}" class="list-group-item active">Bemanning aanbod</a>
    <a href="{{route('jobopenings')}}" class="list-group-item ">Vacatures</a>
    @endif
  </div>

  <!-- Search categories -->
  <div class="categories">
    <label for="categories">Zoek op categorie</label>
    <div class="list-group checked-list-box" id="categories">
      @foreach($category_definitions as $category)
      @if($ad_type == 1)
      <form class="" action="{{route('searchopenings')}}" method="post">
        @elseif($ad_type == 2)
        <form class="" action="{{route('searchrequests')}}" method="post">
          @endif
          {{csrf_field()}}

          <button type="submit" class="list-group-item category-item" data-id="{{$category->id}}">{{$category->name}}</button>
          <input type="hidden" name="category" value="{{$category->id}}">

        </form>
        @endforeach
      </div>
    </div>

    <!-- Search skills -->
    <div class="skills">
      <input type="text" v-model="skills" name="dsdsa" value="">
      <p>@{{skills}}</p>
      <label for="categories">Zoek op vaardigheden</label>
      <div class="list-group checked-list-box" id="skills">
        @foreach($skill_definitions as $skill)
        <li v-model="skills" class="list-group-item skill-item" data-id="{{$skill->id}}">{{$skill->name}}</li>
        @endforeach
      </div>

    </div>
  </div>
