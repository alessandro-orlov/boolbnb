var $ = require( "jquery" );

$(document).ready(function() {

  $('.apartment-message-box').click(function() {
    $(this).find('.open').toggleClass('visible');
    $(this).find('.close').toggleClass('visible');
    $(this).find('.message-detail').toggleClass('visible');
  });

});
