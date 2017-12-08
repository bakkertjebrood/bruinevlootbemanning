$(function(){
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

  //   console.log($(window).scrollTop());
  //
  //   if($(window).scrollTop() > 435){
  //   $('.search').css('position','fixed').css('top','60px').css('width','255');
  // }else{
  //   $('.search').css('position','relative');
  // }

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


// $(function () {
//     $('.list-group.checked-list-box .list-group-item').each(function () {
//
//         // Settings
//         var $widget = $(this),
//             $checkbox = $('<input type="checkbox" class="hidden" />'),
//             color = ($widget.data('color') ? $widget.data('color') : "primary"),
//             style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
//             settings = {
//                 on: {
//                     icon: 'glyphicon glyphicon-check'
//                 },
//                 off: {
//                     icon: 'glyphicon glyphicon-unchecked'
//                 }
//             };
//
//         $widget.css('cursor', 'pointer')
//         $widget.append($checkbox);
//
//         // Event Handlers
//         $widget.on('click', function () {
//             $checkbox.prop('checked', !$checkbox.is(':checked'));
//             $checkbox.triggerHandler('change');
//             updateDisplay();
//         });
//         $checkbox.on('change', function () {
//             updateDisplay();
//         });
//
//
//         // Actions
//         function updateDisplay() {
//             var isChecked = $checkbox.is(':checked');
//
//             // Set the button's state
//             $widget.data('state', (isChecked) ? "on" : "off");
//
//             // Set the button's icon
//             $widget.find('.state-icon')
//                 .removeClass()
//                 .addClass('state-icon ' + settings[$widget.data('state')].icon);
//
//             // Update the button's color
//             if (isChecked) {
//                 $widget.addClass(style + color + ' active');
//             } else {
//                 $widget.removeClass(style + color + ' active');
//             }
//         }
//
//         // Initialization
//         function init() {
//
//             if ($widget.data('checked') == true) {
//                 $checkbox.prop('checked', !$checkbox.is(':checked'));
//             }
//
//             updateDisplay();
//
//             // Inject the icon if applicable
//             if ($widget.find('.state-icon').length == 0) {
//                 $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
//             }
//         }
//         init();
//     });
//
    // $('.skill-item').on('click', function(event) {
    //     event.preventDefault();
    //     var checkedItems = {}, counter = 0;
    //     $("#check-list-box li.active").each(function(idx, li) {
    //         checkedItems[counter] = $(li).text();
    //         counter++;
    //     });
    //     $('#display-skills').val(JSON.stringify(checkedItems, null, '\t'));
    // });
// });




});
