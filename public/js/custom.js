$(function(){
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
  $(window).scroll(function(){
    if($(window).scrollTop() > 253){
    $('.logo').slideUp(500);
  }
    else{
      $('.logo').slideDown(500);
    }
  });


});
