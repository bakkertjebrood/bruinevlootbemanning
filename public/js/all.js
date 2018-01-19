$(function(){

function jobs(){
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
        ad_type:1

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
          ad_type:1

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
}

$('[data-toggle="confirmation"]').confirmation();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
// init datepicker
$('.datepicker').datepicker({
  format:'d-m-yyyy',
  language:'nl'
});

// Phrase welcome
  $('.phrase').delay(500).slideDown().delay(2000);
  $('.phrase p').delay(1000).fadeIn();
  $('.phrase h1').delay(1000).fadeIn();

// Header image background
function slider(){
  i = Math.floor(Math.random() * 4) + 1
  $('.main_image').css('background-image','url("/images/slides/s'+i+'.jpg")');
}

slider();

// logo on scroll remove
if($( window ).width() > 478){
  $(window).scroll(function(){

    if($(window).scrollTop() > 50){
    $('.logo').slideUp(200);
    // $('.logo-small').fadeIn(1000).css('display','inline-block');
  }
    else{
      $('.logo').slideDown(200);
      // $('.logo-small').fadeOut().css('display','none');

    }
  });
}

$('body').find('.select-skills').select2({
  placeholder: ' Selecteer vaardigheden',
  ajax: {
    dataType: 'json',
    url: '/skillsdata',
    delay: 400,
    data: function data(params) {
      return {
        term: params.term
      };
    },
    processResults: function processResults(data, page) {
      return {
        results: data
      };
    }
  }
});

$('body').find('.select-categories').select2({
  placeholder: ' Selecteer categorieën',
  ajax: {
    dataType: 'json',
    url: '/categoriesdata',
    delay: 400,
    data: function data(params) {
      return {
        term: params.term
      };
    },
    processResults: function processResults(data, page) {
      return {
        results: data
      };
    }
  }
});

selectData();



$('body').find('.select-places').select2({
  placeholder: ' Selecteer plaatsen',
  data: places
});

    $('#flash-overlay-modal').modal();

});

var type;
function selectPlace(type){
  selectData();
  var obj;
  var data = $.map(places, function (obj) {
    if(obj.id == place_id){
      console.log(obj);
      if(type == 'p'){
        $('#selectPlace').html(obj.text);
      }else if(type == 'select'){
        $('#selectPlace').html('<option selected="selected" value="'+place_id+'">'+obj.text+'</option>');
      }

    }
  });
}
