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

// logo on scroll remove
  $(window).scroll(function(){
    console.log($(window).scrollTop());

    if($(window).scrollTop() > 342){
    $('.logo').slideUp(500);
  }
    else{
      $('.logo').slideDown(500);
    }
  });


});
