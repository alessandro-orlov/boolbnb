var $ = require( "jquery" );

$(document).ready(function() {


  // $('#send-message-to-host').on('submit', function() {
  //   $('#message-send-success').addClass('visible');
  //   setTimeout(function(){
  //       $('#message-send-success').removeClass('visible');
  //   }, 3000);
  // });

  $('#icon').click(function() {
    location.reload();
  });

  // ========================================================= //
  // ===================== MAPPA ============================= //
  (function() {
    var apartmentTitle = $('.show-top-heading h1').text();

    var showLat = $('.show-latitude').val();
    var showLong = $('.show-longitude').val();

    var latlng = {
      lat: showLat,
      lng: showLong,
    }

    var placesAutocomplete = places({
      appId: 'plAQEOVDX808',
      apiKey: '5e56964f06ab40f6c0d1912086c2be09',
      container: document.querySelector('#input-map')
    });

    var map = L.map('map-example-container', {
      scrollWheelZoom: false,
      zoomControl: true
    });

    var osmLayer = new L.TileLayer(
      'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 1,
        maxZoom: 20,
        attribution: 'Boolbnb - Team 1'
      }
    );

    var markers = [];
    // Imposto la view della mappa in base alla lattitudine e longitudine
    map.setView(new L.LatLng(latlng.lat, latlng.lng), 16);
    map.addLayer(osmLayer);

    var marker = L.marker(latlng);
    marker.addTo(map).bindPopup(apartmentTitle);
    markers.push(marker);

  })();


}); // End document ready
