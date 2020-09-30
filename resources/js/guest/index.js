var $ = require( "jquery" );

$(document).ready(function() {

  // ========================================================= //
  // ==================== SLIDER ============================= //

  // Filtro Stanze
  var roomsRange = document.getElementById("rooms-number");
  var roomsOutput = document.getElementById("rooms-value");
  roomsOutput.innerHTML = roomsRange.value; // Display the default slider value

  // Update the current slider value (each time you drag the slider handle)
  roomsRange.oninput = function() {
      roomsOutput.innerHTML = this.value;
  };

  // Filtro Ospiti/letti
  var guestsRange = document.getElementById("guests-number");
  var guestOutput = document.getElementById("guests-value");
  guestOutput.innerHTML = guestsRange.value; // Display the default slider value

  // Update the current slider value (each time you drag the slider handle)
  guestsRange.oninput = function() {
      guestOutput.innerHTML = this.value;
  };

  // Filtro radius
  var radiusRange = document.getElementById("radius");
  var radiusOutput = document.getElementById("radius-value");
  radiusOutput.innerHTML = radiusRange.value; // Display the default slider value

  // Update the current slider value (each time you drag the slider handle)
  radiusRange.oninput = function() {
      radiusOutput.innerHTML = this.value;
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
        document.querySelector("#city").value = e.suggestion.city || "";
        document.querySelector("#region").value = e.suggestion.administrative || "";
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


}); // End document ready
