var $ = require( "jquery" );

$(document).ready(function() {
  var greetings = $('#greetings');

  // creo un oggetto data corrente
  var currentDate = new Date();

  // individuo l'ora corrente
  var time = currentDate.getHours();

  // Saluto l'utente in base all'orrario corrente

  if (time > 6 && time <= 12) {
    greetings.text('Buon giorno,');
  }
  else if (time > 12 && time <= 18) {
    greetings.text('Buon pomeriggio,');
  }
  else if (time > 18 && time <= 23) {
    greetings.text('Buona sera,');
  }
  else {
    greetings.text('Cacchio ci fai qui? E\' tardi, vai a dormire!');
  }
}); // End document ready