var $ = require( "jquery" );

$(document).ready(function() {


  // ============================================== //
  // ========= BEGIN GREETINGS ==================== //
  var greetings = $('#greetings');

  // creo un oggetto data corrente
  var currentDate = new Date();

  // individuo l'ora corrente
  var time = currentDate.getHours();

  // Saluto l'utente in base all'orrario corrente

  if (time > 6 && time <= 12) {
    greetings.text('Buongiorno,');
  }
  else if (time > 12 && time <= 17) {
    greetings.text('Buon pomeriggio,');
  }
  else if (time > 17 && time <= 23) {
    greetings.text('Buonasera,');
  }
  else {
    greetings.text('Cacchio ci fai qui? E\' tardi, vai a dormire!');
  }


  // ============================================== //
  // ======== DELETE APARTMENT ALERT ============== //
  $('.form-delete').on('submit', function(){
    return confirm('Sei sicuro di voler eliminare questo appartamento?');
  });



}); // End document ready
