;(function($) {
  'use strict';



$('[data-countdown]').each(function() {

  var $this = $(this), finalDate = $(this).data('countdown');

  $this.countdown(finalDate, function(event) {

    var $this = $(this).html('<ul>'+event.strftime(''
   
      + '<li class="day"><span>%D</span> days</li>'
      + '<li class="hour"><span>%H</span> hr </li>'
      + '<li class="min"><span>%M</span> min </li>'
      + '<li class="sec"><span>%S</span> sec </li>')+'</ul>');

  });

});



})(jQuery);
