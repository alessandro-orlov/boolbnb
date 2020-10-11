@extends('layouts.app')

@section('title')
  Boolbnb - tutti gli appartamenti
@endsection

@section('content')
  <section class="container-fluid bool_ap_results">

    {{-- LEFT SIDE --}}
    <div class="row">
      <div class="col-xl-6">

        {{-- BEGIN SEARCH FORM --}}
        <div class="api-search-form-container">
          <form class="py-3 mb-3" id="ms_search-form" method="post" enctype="multipart/form-data">
            @if (!empty($placesInfo['address']))
                <div class="place-search-input">
                  <label class="sr-only">Ricerca un appartamento</label>
                  <input id="address" type="search" class="form-control" class="form-control bool_input" value="<?php echo $placesInfo['address']; ?>" placeholder="Dove vuoi andare?" />
                  <input hidden id="latitude" type="text" name="latitude" value="<?php echo $placesInfo['lat']; ?>">
                  <input hidden id="longitude" type="text" name="longitude" value="<?php echo $placesInfo['lng']; ?>">
                  <input hidden type="text" id="controllo" value="call-ajax">
                </div>
              @else
                  <div class="place-search-input">
                    <label class="sr-only">Ricerca un appartamento</label>
                    <input id="address" type="search" class="form-control" class="form-control bool_input" placeholder="Dove vuoi andare?" />
                    <input hidden id="latitude" type="text" name="latitude" value="">
                    <input hidden id="longitude" type="text" name="longitude" value="">
                  </div>
            @endif

            {{-- Begin search filters --}}
            <div class="all-search-filters">
              <a class="bool_filter">
                Filtri di ricerca
              </a>
            </div>

            <div>
              <div class="bool_dropdown" id="navbarToggleExternalContent">
                {{-- Sliders --}}
                <div class="sliders-box">
                  {{-- Stanze --}}
                  <div class="range-slider">
                    <label for="rooms">Stanze:</label>
                    <input type="range" class="bool_slider" id="rooms-number" min="1" max="10" step="1" value="2">
                    <span id="rooms-value"></span>
                  </div>

                  {{-- Ospiti --}}
                  <div class="range-slider">
                    <label for="guests">Ospiti:</label>
                    <input type="range" class="bool_slider" id="guests-number" min="1" max="10" step="1" value="2">
                    <span id="guests-value"></span>
                  </div>

                  {{-- Range --}}
                  <div class="range-slider">
                    <label for="radius">Distanza:</label>
                    <input type="range" class="bool_slider" id="radius" min="20" max="40" step="10" value="20">
                    <span id="radius-value"></span>
                  </div>
                </div>

                {{-- Services --}}
                <div class="services-box">
                    {{-- WiFi --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input wifi-service checkbox-filters" id="customCheck1" value="">
                      <label class="custom-control-label"  for="customCheck1"><span class="bool_icon"><i class="fas fa-wifi"></i></span> WiFi</label>
                    </div>
                    {{-- Parking --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input parking-service checkbox-filters" id="customCheck2" value="">
                      <label class="custom-control-label"  for="customCheck2"><span class="bool_icon"><i class="fas fa-parking"></i></span>  Parcheggio</label>
                    </div>
                    {{-- Swimming pool --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input swimmingPool-service checkbox-filters" id="customCheck3" value="">
                      <label class="custom-control-label"  for="customCheck3"><span class="bool_icon"><i class="fas fa-swimmer"></i></span> Piscina</label>
                    </div>
                    {{-- Reception --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input reception-service checkbox-filters" id="customCheck4" value="">
                      <label class="custom-control-label"  for="customCheck4"><span class="bool_icon"><i class="fas fa-concierge-bell"></i></span> Portineria</label>
                    </div>
                    {{-- Sauna --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input sauna-service checkbox-filters" id="customCheck5" value="">
                      <label class="custom-control-label"  for="customCheck5"><span class="bool_icon"><i class="fas fa-hot-tub"></i></span> Sauna</label>
                    </div>
                    {{-- Sea view --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input sea-view-service checkbox-filters" id="customCheck6" value="">
                      <label class="custom-control-label"  for="customCheck6"><span class="bool_icon"><i class="fas fa-water"></i></span> Vista Mare</label>
                    </div>
                </div>

              </div>
            </div>
            {{-- End search filters --}}

            {{-- SUBMIT --}}
            <div class="submit-search-btn">
              <div class="input-group-append">
                <button class="btn btn-boolbnb" type="submit">Cerca</button>
              </div>
            </div>
          </form>
        </div>
        {{-- END SEARCH FORM --}}

        {{-- BEGIN APARTMENTS LIST--}}
        <div class="all-apartments-container">

          {{-- PRINT APARTMENTS WITH PHP --}}
          <div class="all-db-apartments">
              @include('layouts.partials.apartmentsphp')
          </div>


          {{-- PRINT APARTMENTS WITH HANDLEBARS --}}
          <div class="apartments-handlebars">
            @php
              
            @endphp
            <div id="ms-sponsored-apartments">
              <ul>
                {{-- append qui sponsored apartments --}}
              </ul>
            </div>

            <div id="ms-normal-apartments">
              <ul>
                {{-- append qui normal apartments --}}
              </ul>
            </div>

          </div>

        </div>
        {{-- END APARTMENTS LIST --}}

      </div>
      {{-- END LEFT SIDE --}}

      {{-- RIGHT SIDE - MAP --}}
      <aside class="col-xl-6 bool_map_col">
        <div class="ricerca">
        </div>
        <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>

        <div>
          {{-- HOMEPAGE LAT & LNG --}}
          <div class="hidden">
              <input type="hidden" class='latitude-value' value="41.29246">
              <input type="hidden" class='longitude-value' value="12.57361">
              <input type="hidden" id="input-map" class="form-control">
          </div>
        </div>
        <div class="map bool_map_container">
            <div id="map-example-container"></div>
        </div>

      </aside>
      {{-- END RIGHT SIDE --}}

    </div>
  </section>
  {{-- END APARTMENTS & MAP SECTION --}}

  <!-- ================================================================  -->
  <!-- ===================== SCRIPT ===================================  -->
  <script src="{{asset('js/boolbnb/guest/index.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
  <script>
      (function() {
        var placesAutocomplete = places({
          appId: 'plAQEOVDX808',
          apiKey: '5e56964f06ab40f6c0d1912086c2be09',
          container: document.querySelector('#address')
        });
        var $address = document.querySelector('#address')
          placesAutocomplete.on('change', function(e) {
            document.querySelector("#address").value = e.suggestion.value || "";
            document.querySelector("#latitude").value = e.suggestion.latlng.lat || "";
            document.querySelector("#longitude").value = e.suggestion.latlng.lng || "";
          });
          placesAutocomplete.on('clear', function() {
            $address.textContent = 'none';
          });
      })();
  </script>
  <script id="entry-template" type="text/x-handlebars-template">
      @include('layouts/partials/handlebars-apartments')
  </script>
@endsection
