var $ = require( "jquery" );
const Handlebars = require("handlebars");

$(document).ready(function() {

  var controllo = $('#controllo').val();

  if (controllo == 'call-ajax') {
    ajaxCallFilteredApartment();
  }

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


  // quando clicco il bottone Invia parte la chiamata Ajax
  $('.btn-boolbnb').click(function() {
    event.preventDefault(); // Impedisce di fare il submit del form

    ajaxCallFilteredApartment();

  });


  function ajaxCallFilteredApartment() {

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

    // Resset del HTML
    $('.all-db-apartments').html('');
    $('#ms-sponsored-apartments ul').html('');
    $('#ms-normal-apartments ul').html('');
    // Chiudo la finestra dei filtri se sono aperti
    $('.bool_dropdown').slideUp();

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
        var normalApartments = data.normal['data'].reverse();

        printApartments( data['sponsored'], normalApartments );

        // printApartments(data['sponsored'], data.normal['data'] ); // OK

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

  function printApartments(dataSponsored, dataNormal) {
    var source = $('#entry-template').html();
    var template = Handlebars.compile(source);
    var url = window.location.protocol + '//' + window.location.hostname + ':8000/';

    console.log(url);

    // Appartamenti sponsorizzati
    for (var i = 0; i < dataSponsored.length; i++) {
      var singleSponsoredApartment = dataSponsored[i];
      console.log(singleSponsoredApartment);

      var imageSponsored;
      if (singleSponsoredApartment.main_img === null) {
        imageSponsored = url + 'img/no-image/no-image.png';
      } else if (singleSponsoredApartment.main_img.includes('mpixel')) {
        imageSponsored = singleSponsoredApartment.main_img;
      } else {
        imageSponsored = url + 'storage/' + singleSponsoredApartment.main_img;
      }

      var contextSponsored = {
        'address': singleSponsoredApartment.address,
        'city': singleSponsoredApartment.city,
        'region': singleSponsoredApartment.region,
        'description': singleSponsoredApartment.description,
        'latitude': singleSponsoredApartment.latitude,
        'longitude': singleSponsoredApartment.longitude,
        'main_img': imageSponsored,
        'mq': singleSponsoredApartment.mq,
        'num_baths': singleSponsoredApartment.num_baths,
        'num_beds': singleSponsoredApartment.num_beds,
        'num_rooms': singleSponsoredApartment.num_rooms,
        'title': singleSponsoredApartment.title,
        'user_id': singleSponsoredApartment.user_id,
        'id': singleSponsoredApartment.id,
        'price': singleSponsoredApartment.price,
      }

      var htmlSponsored = template(contextSponsored);
      // console.log(singleSponsoredApartment);

      // Inserisco i risultati della ricerca
      $('#ms-sponsored-apartments ul').append(htmlSponsored);
    }

    // Appartamenti normali
    for (var i = 0; i < dataNormal.length; i++) {
      var singleApartment = dataNormal[i];
      console.log(singleApartment);

      var image;
      if (singleApartment.main_img === null) {
        image = url + 'img/no-image/no-image.png';
      } else if (singleApartment.main_img.includes('mpixel')) {
        image = singleApartment.main_img;
      } else {
        image = url + 'storage/' + singleApartment.main_img;
      }

      var context = {
        'address': singleApartment.address,
        'city': singleApartment.city,
        'region': singleApartment.region,
        'description': singleApartment.description,
        'latitude': singleApartment.latitude,
        'longitude': singleApartment.longitude,
        'main_img': image,
        'mq': singleApartment.mq,
        'num_baths': singleApartment.num_baths,
        'num_beds': singleApartment.num_beds,
        'num_rooms': singleApartment.num_rooms,
        'title': singleApartment.title,
        'user_id': singleApartment.user_id,
        'id': singleApartment.id,
        'price': singleApartment.price,
      }

      var html = template(context);
      console.log(singleApartment);

      // Inserisco i risultati della ricerca
      $('#ms-normal-apartments ul').append(html);
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
          scrollWheelZoom: false,
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
        findBestZoom();

        function findBestZoom() {
           var featureGroup = L.featureGroup(markers);
           map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
         }

    })();

  } // End generateMap function


}); // End Document ready
