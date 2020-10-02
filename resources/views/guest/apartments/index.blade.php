@extends('layouts.app')

@section('content')
  <section class="container-fluid bool_ap_results">

    {{-- LEFT SIDE --}}
    <div class="row">
      <div class="col-xl-6">

        {{-- BEGIN SEARCH FORM --}}
        <div class="api-search-form-container">
          <form class="py-3 mb-3 " method="post" enctype="multipart/form-data">

            <div class="place-search-input">
              <label class="sr-only">Ricerca un appartamento</label>
              <input id="input-map" type="search" class="form-control" class="form-control bool_input" placeholder="Dove vuoi andare" />
            </div>

            <div>
              {{-- SEARCH INFO --}}
              <input hidden id="latitude" type="text" name="latitude" value="">
              <input hidden id="longitude" type="text" name="longitude" value="">
            </div>

            {{-- inizio filtri di ricerca --}}
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
                    <input type="range" class="bool_slider" id="rooms-number" min="1" max="9" step="1" value="3">
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
                      <input type="checkbox" class="custom-control-input wifi-service" id="customCheck1" value="">
                      <label class="custom-control-label"  for="customCheck1"><span class="bool_icon"><i class="fas fa-wifi"></i></span> WiFi</label>
                    </div>
                    {{-- Parking --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input parking-service" id="customCheck2" value="">
                      <label class="custom-control-label"  for="customCheck2"><span class="bool_icon"><i class="fas fa-parking"></i></span>  Parcheggio</label>
                    </div>
                    {{-- Piscina --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input swimmingPool-service" id="customCheck3" value="">
                      <label class="custom-control-label"  for="customCheck3"><span class="bool_icon"><i class="fas fa-swimmer"></i></span> Piscina</label>
                    </div>
                    {{-- Portineria --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input reception-service" id="customCheck4" value="">
                      <label class="custom-control-label"  for="customCheck4"><span class="bool_icon"><i class="fas fa-concierge-bell"></i></span> Portineria</label>
                    </div>
                    {{-- Sauna --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input sauna-service" id="customCheck5" value="">
                      <label class="custom-control-label"  for="customCheck5"><span class="bool_icon"><i class="fas fa-hot-tub"></i></span> Sauna</label>
                    </div>
                    {{-- Vista Mare --}}
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input sea-view-service" id="customCheck6" value="">
                      <label class="custom-control-label"  for="customCheck6"><span class="bool_icon"><i class="fas fa-water"></i></span> Vista Mare</label>
                    </div>
                </div>

              </div>
            </div>
            {{-- fine filtri di ricerca --}}

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

          <!-- PRINT APARTMENTS WITH PHP -->
          <div class="all-db-apartments">
              @include('layouts.partials.apartmentsphp')
          </div>


          {{-- handlebars tamplate --}}
          <div class="apartments-handlebars">
              {{-- append qui --}}
          </div>

        </div>
        {{-- END APARTMENTS LIST --}}

      </div> <!-- end col-xl-6 -->
      {{-- END LEFT SIDE --}}

      {{-- RIGHT SIDE - MAP --}}
      <aside class="col-xl-6 bool_map_col">
        <div class="ricerca">
        </div>
        <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
        <div class="bool_map_container">
          <div id="map-example-container"></div>
        </div>
      </aside>
      {{-- END RIGHT SIDE --}}

    </div>
  </section>
  {{-- fine sezione appartamenti e mappa --}}

  <!-- ================================================================  -->
  <!-- ===================== SCRIPT ===================================  -->
  <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
  {{-- <script src="{{asset('js/boolbnb/search.js')}}"></script> --}}
  <script src="{{asset('js/boolbnb/guest/index.js')}}"></script>

  <script id="entry-template" type="text/x-handlebars-template">
      @include('layouts/partials/handlebars-apartments')
  </script>
@endsection
