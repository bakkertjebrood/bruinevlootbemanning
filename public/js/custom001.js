$(function(){

  $(function(){
    $('.has-spinner').click(function() {
        $(this).toggleClass('active');
    });
});

  $('.btn-primary').click(function(){
    $(this).disabled
  });

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
