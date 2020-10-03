var $ = require( "jquery" );
const Handlebars = require("handlebars");

$(document).ready(function() {


  generateMap();

  // ========================================================= //
  // ================= TOGGLE-FILTERS ======================== //
  $('.all-search-filters .bool_filter').click(function() {
    $('.bool_dropdown').slideToggle();
  });


  // ========================================================= //
  // ==================== SLIDERS ============================ //

  // Filtro Stanze
  var roomsRange = document.getElementById("rooms-number");
  var roomsOutput = document.getElementById("rooms-value");
  roomsOutput.innerHTML = roomsRange.value; // Valore slider di default
  // Aggiorno il valore del range muovendo lo slider
  roomsRange.oninput = function() {
      roomsOutput.innerHTML = this.value;
  };

  // Filtro Ospiti/letti
  var guestsRange = document.getElementById("guests-number");
  var guestOutput = document.getElementById("guests-value");
  guestOutput.innerHTML = guestsRange.value; // Valore slider di default
  // Aggiorno il valore del range muovendo lo slider
  guestsRange.oninput = function() {
      guestOutput.innerHTML = this.value;
  };

  // Filtro radius
  var radiusRange = document.getElementById("radius");
  var radiusOutput = document.getElementById("radius-value");
  radiusOutput.innerHTML = radiusRange.value; // Valore slider di default
  // Aggiorno il valore del range muovendo lo slider
  radiusRange.oninput = function() {
      radiusOutput.innerHTML = this.value;
  };

  // ========================================================= //
  // ===================== SEARCH ============================ //
  var latitude;
  var longitude;
  var rooms;
  var beds;
  var radius;
  var wifi;
  var parking;
  var swimmingPool;
  var reception;
  var sauna;
  var seaView;

  // quando clicco il bottone Invia parte la chiamata Ajax
  $('.btn-boolbnb').click(function() {

    // Resset del HTML
    $('.all-db-apartments').html('');
    $('.apartments-handlebars').html('');
    // Chiudo la finestra dei filtri se sono aperti
    $('.bool_dropdown').slideUp();



    event.preventDefault(); // Impedisce di fare il submit del form

    // Sliders
    latitude = $('#latitude').val();
    longitude = $('#longitude').val();
    rooms = $('#rooms-number').val();
    beds = $('#guests-number').val();
    radius = $('#radius').val();

    // Checkboxes
    wifi = $('.wifi-service');
    parking = $('.parking-service');
    swimmingPool = $('.swimmingPool-service');
    reception = $('.reception-service');
    sauna = $('.sauna-service');
    seaView = $('.sea-view-service');

    // Verifica Checked/Unchecked
    wifi.is(":checked") ? wifi = 'checked' : wifi = 'unchecked';
    parking.is(":checked") ? parking = 'checked' : parking = 'unchecked';
    swimmingPool.is(":checked") ? swimmingPool = 'checked' : swimmingPool = 'unchecked';
    reception.is(":checked") ? reception = 'checked' : reception = 'unchecked';
    sauna.is(":checked") ? sauna = 'checked' : sauna = 'unchecked';
    seaView.is(":checked") ? seaView = 'checked' : seaView = 'unchecked';

    // console.log(latitude);
    // console.log(longitude);
    // console.log('numero stanze ' + rooms);
    // console.log(beds);
    // console.log(radius);
    // console.log(wifi);
    // console.log(parking);
    // console.log(swimmingPool);
    // console.log(reception);
    // console.log(sauna);
    // console.log(seaView);


    $('.latitude-value').val(latitude);
    $('.longitude-value').val(longitude);

    ajaxCallFilteredApartment();

    // Resetto i filtri ai valori di default
    // $('#ms_search-form')[0].reset();

  });

  function ajaxCallFilteredApartment() {

    $.ajax({
      url: 'http://127.0.0.1:8000/api/search',
      method: 'GET',
      data: {
        latitude: latitude,
        longitude: longitude,
        radius: radius,
        rooms: rooms,
        beds: beds,
        wifi: wifi,
        parking: parking,
        swimmingPool: swimmingPool,
        reception: reception,
        sauna: sauna,
        seaView: seaView,
      },
      success: function(data) {
        // Funzione handlebars per stampare la risposta
        printApartments(data);

        // Rimuovo la mappa
        $('#map-example-container').remove();
        // Inserisco la mappa con i marker
        $('.bool_map_container').html('<div id="map-example-container"></div>');

        generateMap();
        // console.log(data);
      },
      error: function(request, state, error) {
        alert("E' avvenuto un errore. " + error);
      },
    });
  }

  function printApartments(data) {
    var source = $('#entry-template').html();
    var template = Handlebars.compile(source);

    for (var i = 0; i < data.length; i++) {
      var singleApartment = data[i];
      var html = template(singleApartment);

      // Inserisco i risultati della ricerca
      $('.apartments-handlebars').append(html);
    }
  };

  // ========================================================= //
  // ===================== MAPPA ============================= //
  function generateMap() {
    (function() {

        var latlng = {
                lat: $('.latitude-value').val(),
                lng: $('.longitude-value').val()
            };
        // console.log(latlng);

        var apartments = [];

        // Ciclo su ogni appartamento che sia visibile quindi con una sola classe
        $('.bool_ap').each(function(){
            var apartment = {}; // Popolazione oggetto con lat e lng per ogni appartamento
            apartment.title = $(this).find('.bool_info_apt h4').text();
            apartment.lat = $(this).find('.latitude').text();
            apartment.lng = $(this).find('.longitude').text();

            apartments.push(apartment);
        });


        var map = L.map('map-example-container', {
          scrollWheelZoom: true,
          zoomControl: true
        });

        var osmLayer = new L.TileLayer(
          'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 1,
            maxZoom: 19,
            attribution: 'Boolean Team 1'
          }
        );
        map.addLayer(osmLayer);

        var markers = [];

        for (var i = 0; i < apartments.length; i++) {
                var apartment = apartments[i];
                addApartmentToMap(apartment);
        }

        // Aggiungo i markers sulla Mappa
        function addApartmentToMap(apartment) {
                var marker = L.marker({'lat': apartment.lat, 'lng': apartment.lng})
                marker.addTo(map).bindPopup(apartment.title).openPopup();
                markers.push(marker);
        }

        if (latlng.lat == 41.29246) {
          map.setView(new L.LatLng(latlng.lat, latlng.lng), 6);
        } else {
          map.setView(new L.LatLng(latlng.lat, latlng.lng), 12);
        }

    })();

  } // End generateMap function


}); // End Document ready
