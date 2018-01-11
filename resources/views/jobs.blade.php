@extends('layouts.master')

@section('title')
Bruinevlootbemanning
@stop

@section('header')
@include('inc.navbar')
@include('inc.cta')
@stop

@section('content')
<div  id="jobs" class="container">
  <div class="col-lg-3">
    <div class="search">

      <div class="list-group notice profile-menu">
        <a href="{{route('jobrequest')}}" class="list-group-item">
          <span class="glyphicon glyphicon-bullhorn"></span>
          Plaats oproep</a>
        <a href="{{route('jobopening')}}" class="list-group-item">
          <span class="glyphicon glyphicon-ok-circle"></span>
          Plaats vacature</a>
      </div>

      <div class="list-group profile-menu">
        <label for="search">Alles tonen</label>
        @if($ad_type == 1)
        <a href="{{route('jobrequests')}}" class="list-group-item ">
          <span class="glyphicon glyphicon-bullhorn"></span>
          Bemanning aanbod</a>
        <a href="{{route('jobopenings')}}" class="list-group-item active">
          <span class="glyphicon glyphicon-ok-circle"></span>
          Vacatures</a>
        @elseif($ad_type == 2)
        <a href="{{route('jobrequests')}}" class="list-group-item active">
          <span class="glyphicon glyphicon-bullhorn"></span>
          Bemanning aanbod</a>
        <a href="{{route('jobopenings')}}" class="list-group-item ">
          <span class="glyphicon glyphicon-ok-circle"></span>
          Vacatures</a>
        @endif
      </div>

      <!-- Start / end -->
      <div class="daterange">
        @if($ad_type == 1)
        <label for="daterange">Periode</label>
        @elseif($ad_type == 2)
        <label for="daterange">Beschikbaar tussen</label>
        @endif

        <div class="input-group input-daterange" id="daterange">
          <input type="text" data-date-format='dd-mm-yyyy' class="form-control " id="startdate" v-model="startdate" value="" placeholder="20-5-2018">
          <div class="input-group-addon"><small>tot</small></div>
          <input type="text" data-date-format='dd-mm-yyyy' class="form-control" id="enddate" v-model="enddate" value="" placeholder="20-5-2019">
          <span class="input-group-btn">
            <button class="btn btn-primary" @click="addDates()" type="button"><span class="glyphicon glyphicon-search"></span></button>
          </span>
        </div><br>
      </div>

      <!-- Search categories -->
      <div class="categories">
        <label for="categories">Zoek op categorie</label>
        <div class="list-group checked-list-box" id="categories">
          <a v-for="category in categories" @click="addCategory(categories,category)" :class="['list-group-item',{active:category.isActive}]">
            @{{category.name}}
            <!-- <span class="badge">1</span> -->
          </a>
        </div>
      </div>

      <!-- Search skills -->
      <div class="">
        <label for="categories">Zoek op vaardigheden</label>
        <div class="list-group checked-list-box">
          <a v-for="skill in skills" @click="addSkill(skills,skill)" :class="['list-group-item',{active:skill.isActive}]" >@{{skill.name}}</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Main ads grid -->
  <div class="col-lg-9">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><small><a href="{{url('/')}}">Welkom</a></small></li>
      <li class="breadcrumb-item active" aria-current="page">
        @if($ad_type == 1)
        Vacature overzicht
        @else
        Oproepen overzicht
        @endif
      </li>
    </ol>

    <div class="">
      <h2>
        @if($ad_type == 1)
        Vacatures
        @else
        Oproepen
        @endif
        <small> het volledige aanbod</small></h2><hr>
      </div>
      @include('flash::message')

      <div v-if="jobs.length == 0" class="well">
        <i class="">Geen gegevens gevonden</i>
      </div>
      <div>
          <transition-group name="list" tag="p">
        <div :key="job.id" v-for="job in jobs" class="panel panel-default list-item">
          <div class="panel-heading">
            <h3 class="panel-title">@{{job.name}}</h3>
          </div>
          <div class="panel-body">
            <div class="media">
              <div class="media-left">
                <a :href="'/job/'+job.id">
                  <img class="media-object ads-image-m hidden-xs" :src="'{{url('uploads/photo')}}/' + job.photo" alt="Photo">
                </a>
              </div>
              <div class="media-body">
                <div class="col-sm-6 col-md-4 col-lg-12">
                  <p>@{{job.description | truncate(300) }}</p>
                </div>

                <div class="col-sm-3 col-md-6 col-lg-12">
                  <strong>Periode: </strong><span>@{{job.startdate | moment("D-M-Y")}} tot @{{job.enddate | moment("D-M-Y")}} </span><br>
                  <strong>Geplaatst op: </strong><span>@{{job.created_at | moment("D-M-Y")}} </span><br>

                </div>
              </div>
            </div>
          </div>
          <div class="panel-footer clearfix">
            <span class="pull-right ">
              <a type="button" class="btn btn-m btn-default" :href="'/job/'+job.id" name="button">Meer informatie</a>
              <a type="button" class="btn btn-m btn-primary" data-toggle="modal" :data-target="'#ad_respond'+job.id" name="respond">Reageer</a>
            </span>
          </div>
          @if(Auth::user())
          <div class="modal fade" :id="'ad_respond'+job.id" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form class="" action="{{route('respond')}}" method="post">
                  {{csrf_field()}}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="">Reageer op @{{job.name}}</h4>
                </div>
                <div class="modal-body">

                  <div class="form-group">
                    <label for="body">Uw bericht</label>
                    <textarea rows="7" class="form-control" id="body" name="body" placeholder="Schrijf hier uw bericht" required="required"></textarea>
                    <input type="hidden" name="ad_id" :value="job.id">
                    <input type="hidden" name="user_id" value="{{isset(Auth::user()->id)}}">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                  <button type="submit" class="btn btn-primary">Versturen</button>
                </div>
              </form>
              </div>
            </div>
          </div>
          @else
          <div class="modal fade" id="ad_respond" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="">U dient in te loggen om te kunnen reageren</h4>
                </div>
                <div class="modal-body">

                  @include('inc.login')

                </div>

              </div>
            </div>
          </div>
          @endif
        </div>
      </transition-group>
      </div>

      <div class="pagination">

      </div>
    </div>
  </div>
  @stop

  @section('scripts')
  <script type="text/javascript">
  // Render jobopenings
  var jobs = new Vue({
    el: '#jobs',

    data:{
      jobs: [],
      skills: '',
      categories: '',
      selected_skills: [],
      selected_categories: [],
      ad_type: '',
      startdate: '',
      enddate: ''
    },

    filters: {
      truncate: function(string, value) {
        return string.substring(0, value) + '...';
      }
    },
    mounted(){
      // jobs
      axios.post('/jobs/data', {
        ad_type:{{$ad_type}}

      }).then(response => {
        this.jobs = response.data;
      });
      // skills
      axios.get('/skills/data').then(response =>{
        this.skills = response.data;

      });

      // categories
      axios.get('/categories/data').then(response =>
        this.categories = response.data
      );

      $("#startdate").datepicker({
        format:'d-m-yyyy',
        language:'nl'}).on("changeDate", () => {this.startdate = $('#startdate').val()}
      );

      $("#enddate").datepicker({
        format:'d-m-yyyy',
        language:'nl'}).on("changeDate", () => {this.enddate = $('#enddate').val()}
      );

    },

    methods:{
      addDates(){
        this.data();
      },
      addSkill(skills, skill){
        skill.isActive = !skill.isActive;
        var _this = this;
        this.selected_skills = [];
        skills.forEach(function(skill,index){
          if(skill.isActive){
            _this.selected_skills.push(skill.id);
          }
        });
        this.data();
      },
      addCategory(categories,category){
        category.isActive = !category.isActive;
        var _this = this;
        this.selected_categories = [];
        categories.forEach(function(category,index){
          if(category.isActive){
            _this.selected_categories.push(category.id);
          }
        });
        this.data();
      },
      data(){
        axios.post('/jobs/data', {
          startdate: this.startdate,
          enddate: this.enddate,
          categories: this.selected_categories,
          skills: this.selected_skills,
          ad_type:{{$ad_type}}

        }).then(response => {
          this.jobs = response.data;
        })
        .catch(function (error) {
          // console.log(error);
        });
      }
    }
    // end methods
  });
</script>
@stop
