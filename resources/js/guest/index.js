var $ = require( "jquery" );
const Handlebars = require("handlebars");

$(document).ready(function() {

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

    // Azzeriamo innerHTML
    // $('apartments-php-container').addClass('hidden');


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

    console.log(latitude);
    console.log(longitude);
    console.log(rooms);
    console.log(beds);
    console.log(radius);

    console.log(wifi);
    console.log(parking);
    console.log(swimmingPool);
    console.log(reception);
    console.log(sauna);
    console.log(seaView);
    ajaxCallFilteredApartment(); // DA FARE ANCORA
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
        console.log(data)
        // Funzione handlebars per stampare la risposta
        printApartments(data);
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
      $('.apartments-handlebars').append(html);
    }
  };

  // ========================================================= //
  // ===================== MAPPA ============================= //
  (function() {
    var placesAutocomplete = places({
      appId: 'plAQEOVDX808',
      apiKey: '5e56964f06ab40f6c0d1912086c2be09',
      container: document.querySelector('#input-map')
    });
    var $address = document.querySelector('#input-map')
      placesAutocomplete.on('change', function(e) {
        document.querySelector("#latitude").value = e.suggestion.latlng.lat || "";
        document.querySelector("#longitude").value = e.suggestion.latlng.lng || "";
      });
      placesAutocomplete.on('clear', function() {
        $address.textContent = 'none';
      });

    var map = L.map('map-example-container', {
      scrollWheelZoom: true,
      zoomControl: true
    });

    var osmLayer = new L.TileLayer(
      'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 1,
        maxZoom: 13,
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
      }
    );

    var markers = [];

    map.setView(new L.LatLng(41.29246, 12.57361), 6);
    map.addLayer(osmLayer);

    placesAutocomplete.on('suggestions', handleOnSuggestions);
    placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
    placesAutocomplete.on('change', handleOnChange);
    placesAutocomplete.on('clear', handleOnClear);

    function handleOnSuggestions(e) {
      markers.forEach(removeMarker);
      markers = [];

      if (e.suggestions.length === 0) {
        map.setView(new L.LatLng(0, 0), 1);
        return;
      }

      e.suggestions.forEach(addMarker);
      findBestZoom();
    }

    function handleOnChange(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            markers = [marker];
            marker.setOpacity(1);
            findBestZoom();
          } else {
            removeMarker(marker);
          }
        });
    }

    function handleOnClear() {
      map.setView(new L.LatLng(0, 0), 1);
      markers.forEach(removeMarker);
    }

    function handleOnCursorchanged(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            marker.setOpacity(1);
            marker.setZIndexOffset(1000);
          } else {
            marker.setZIndexOffset(0);
            marker.setOpacity(0.5);
          }
        });
    }

    function addMarker(suggestion) {
      var marker = L.marker(suggestion.latlng, {opacity: .4});
      marker.addTo(map);
      markers.push(marker);
    }

    function removeMarker(marker) {
      map.removeLayer(marker);
    }

    function findBestZoom() {
      var featureGroup = L.featureGroup(markers);
      map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
    }
  })();

}); // End Document ready
