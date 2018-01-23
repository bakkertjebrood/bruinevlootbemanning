<template lang="html">
  <div class="">


    <div class="col-lg-3">
      <div class="search">

        <div class="list-group notice profile-menu">
          <a href="/job/request" class="list-group-item">
            <span class="glyphicon glyphicon-bullhorn"></span>
            Plaats oproep</a>
            <a href="/job/opening" class="list-group-item">
              <span class="glyphicon glyphicon-ok-circle"></span>
              Plaats vacature</a>
            </div>


            <div class="list-group profile-menu">
              <label for="search">Alles tonen</label>
              <a href="#" @click="addType('2')" class="list-group-item " :class="{active:type2}">
                <span class="glyphicon glyphicon-bullhorn"></span>
                Bemanning aanbod</a>
                <a href="#" @click="addType('1')" class="list-group-item" :class="{active:type1}">
                  <span class="glyphicon glyphicon-ok-circle"></span>
                  Vacatures</a>
                </div>

                <!-- Start / end -->
                <div class="daterange">
                  <label for="daterange">Periode</label>

                  <div class="input-group input-daterange clearfix" id="daterange">
                    <datepicker bootstrapStyling input-class="daterange"  readonly="" placeholder="01 jan 2018" language="nl" data-date-format='dd-mm-yyyy' v-model="startdate"></datepicker>
                    <div class="input-group-addon">tot</div>
                    <datepicker bootstrapStyling placeholder="01 jan 2019" language="nl" data-date-format='dd-mm-yyyy' v-model="enddate"></datepicker>
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
                      {{category.name}}
                      <!-- <span class="badge">1</span> -->
                    </a>
                  </div>
                </div>

                <!-- Search skills -->
                <div class="">
                  <label for="categories">Zoek op vaardigheden</label>
                  <div class="list-group checked-list-box">
                    <a v-for="skill in skills" @click="addSkill(skills,skill)" :class="['list-group-item',{active:skill.isActive}]" >{{skill.name}}</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Main ads grid -->
            <div class="col-lg-9">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><small><a href="#">Welkom</a></small></li>
                <li class="breadcrumb-item active" aria-current="page">
                  Overzicht
                </li>
              </ol>

              <div class="">
                <h2>
                  Advertenties
                  <small> het volledige aanbod</small></h2><hr>
                </div>

                <div v-if="jobs.length == 0" class="well">
                  <i class="">Geen gegevens gevonden</i>
                </div>
                <div>
                  <transition-group name="list" tag="p">
                    <div :key="job.id" v-for="job in jobs" class="panel panel-default list-item">
                      <div class="panel-heading">
                        <h3 class="panel-title">{{job.name}}</h3>
                      </div>
                      <div class="panel-body">
                        <div class="media">
                          <div class="media-left">
                            <a :href="'/job/'+job.id">
                              <img class="media-object ads-image-m hidden-xs" :src="'/uploads/photo/' + job.photo" alt="Photo">
                            </a>
                          </div>
                          <div class="media-body">
                            <div class="col-sm-6 col-md-4 col-lg-12">
                              <p>{{job.description | truncate(300) }}</p>
                            </div>

                            <div class="col-sm-3 col-md-6 col-lg-12">
                              <strong>Periode: </strong><span>{{job.startdate | moment("D-M-Y")}} tot {{job.enddate | moment("D-M-Y")}} </span><br>
                              <strong>Geplaatst op: </strong><span>{{job.created_at | moment("D-M-Y")}} </span><br>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel-footer clearfix">
                        <span class="pull-right ">
                          <a type="button" class="btn btn-m btn-default" :href="'/job/'+job.id" name="button">Meer informatie</a>
                          <a type="button" class="btn btn-m btn-primary"  @click="responseReset()" data-toggle="modal" :data-target="'#ad_respond'+job.id" name="respond">Reageer</a>
                        </span>
                      </div>
                      <div class="modal fade" :id="'ad_respond'+job.id" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form class="" action="/job/respond" method="post">

                              <div class="modal-header">
                                <button type="button" @click="responseReset()" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="">Reageer op {{job.name}}</h4>
                              </div>
                              <div class="modal-body">

                                <div class="form-group">
                                  <label for="body">Uw bericht</label>
                                  <textarea rows="7" class="form-control" name="body" placeholder="Schrijf hier uw bericht" v-model="responseBody" required="required"></textarea>

                                  <div v-html="responseMessage">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" @click="responseReset()" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                                <button type="button" @click="submitResponse(job.id)" class="btn btn-primary">Versturen</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                    </div>
                  </transition-group>
                </div>

                <div class="pagination">

                </div>
              </div>
            </div>
          </template>

          <script>
          import Datepicker from 'vuejs-datepicker';

          export default {
            components: {
              Datepicker
            },
            data: function(){
              return {
                type:'2',
                type1: false,
                type2: true,
                jobs: [],
                skills: '',
                categories: '',
                selected_skills: [],
                selected_categories: [],
                ad_type: '',
                startdate: '',
                enddate: '',
                responseMessage: '',
                responseBody: ''
              }},

              filters: {
                truncate: function(string, value) {
                  return string.substring(0, value) + '...';
                }
              },
              mounted(){
                // jobs
                axios.post('/jobs/data', {
                  ad_type:this.type

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

              },

              methods:{
                addType(type){
                  this.type = type;
                  if(this.type == 1){
                    this.type1 = true
                    this.type2 = false;
                  }else{
                    this.type2 = true;
                    this.type1 = false;
                  }
                  this.data();
                },
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
                    ad_type:this.type

                  }).then(response => {
                    this.jobs = response.data;
                  })
                  .catch(function (error) {
                    // console.log(error);
                  });
                },
                submitResponse(id){
                  axios.post('/job/respond', {
                    ad_id: id,
                    body: this.responseBody
                  }).then(response => {
                    // console.log(response.data);
                    if(response.data == true){

                      this.responseMessage = '<strong class="text-success" ><span class="glyphicon glyphicon-ok"></span> Uw reactie is verstuurd</strong>';
                    }else if(response.data == false){
                      this.responseMessage = '<strong class="text-danger" ><span class="glyphicon glyphicon-remove"></span> U kunt niet reageren op uw eigen advertentie</strong>';
                    }else{
                      this.responseMessage = '<a href="/login"><strong class="text-warning" ><span class="glyphicon glyphicon-lock"></span> Log in of registreer om te kunnen reageren</strong></a>';
                    }
                  }).catch(response =>{
                    // console.log('test');
                  });
                },
                responseReset(){
                  this.responseBody = '';
                  this.responseMessage = '';

                }
              }
              // end methods
              // });
            }
            </script>

            <style lang="css">
            .daterange input[type="text"]{
              background-color:white;
            }
            </style>
