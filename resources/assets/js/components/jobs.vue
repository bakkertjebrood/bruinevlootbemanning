<template>

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

      <div>

        <div v-for="job in jobs" class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>@{{job.name}}</strong></h3>
          </div>
          <div class="panel-body">
            <div class="media">
              <div class="media-left">
                <a href="">
                  <img class="media-object ads-image-m" :src="'{{url('uploads/photo')}}/' + job.photo" alt="Photo">
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
              <a type="button" class="btn btn-m btn-primary" href="" name="respond">Reageer</a>
            </span>
          </div>
        </div>
      </div>
      <div class="pagination">

      </div>
    </div>


    <div class="col-lg-3">
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
            <a v-for="category in categories" @click="addCategory(categories,category)" :class="['list-group-item',{active:category.isActive}]" >@{{category.name}}</a>
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

</template>

<script>
export default {
  el: '#jobs',

  data:{
    jobs: [],
    skills: '',
    categories: '',
    selected_skills: [],
    selected_categories: [],
    isActive: false
  },

  filters: {
    truncate: function(string, value) {
      return string.substring(0, value) + '...';
    }

  },

  mounted(){
    // jobs
    axios.post('/jobs/openings/data', {

    }).then(response => {
      this.jobs = response.data;

    });

    // skills
    axios.get('/skills/data').then(response =>{
      this.skills = response.data;

    });
    axios.get('/categories/data').then(response => this.categories = response.data);

    //

  },

  methods:{
    addSkill: function (skills,skill) {

      skill.isActive = !skill.isActive;
      var _this = this;
      this.selected_skills = [];
      skills.forEach(function(skill,index){
        if(skill.isActive){
          _this.selected_skills.push(skill.id);
        }
      });

      // jobs
      axios.post('/jobs/openings/data', {
        skills: this.selected_skills

      }).then(response => {
        this.jobs = response.data;
      });
    },

    addCategory: function (categories,category) {

      category.isActive = !category.isActive;
      var _this = this;
      this.selected_categories = [];
      categories.forEach(function(category,index){
        if(category.isActive){
          _this.selected_categories.push(category.id);
        }
      });

      // jobs
      axios.post('/jobs/openings/data', {
        categories: this.selected_categories

      }).then(response => {
        this.jobs = response.data;
      });
    }


  }
}
</script>

<style lang="css">
</style>
