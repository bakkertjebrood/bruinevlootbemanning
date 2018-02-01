
/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

window.Vue = require('vue');

const moment = require('moment');
require('moment/locale/nl');

Vue.use(require('vue-moment'), {
    moment
});



Vue.component('jobs', require('./components/jobs.vue'));

// const app = new Vue({
//     el: '#app'
// });

import Datepicker from 'vuejs-datepicker';

var jobs = new Vue({
  components: {
    Datepicker
  },
  el: '#app',
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
    console.log(window.location.pathname);

    if(window.location.pathname == '/job/requests'){
      this.adtype = 2
    }else{
      this.adtype = 1
    }


    axios.post('/jobs/data', {
      ad_type:this.adtype
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
    // $("#startdate").datepicker({
    //   format:'d-m-yyyy',
    //   language:'nl'}).on("changeDate", () => {this.startdate = $('#startdate').val()}
    // );
    // $("#enddate").datepicker({
    //   format:'d-m-yyyy',
    //   language:'nl'}).on("changeDate", () => {this.enddate = $('#enddate').val()}
    // );
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
        ad_type:this.adtype
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
