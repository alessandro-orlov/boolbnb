@extends('layouts.app')
@section('content')

{{-- inizio sezione appartamenti e mappa --}}
<section class="container-fluid bool_ap_results">

{{-- inizio colonna sinistra con appartamenti e ricerca --}}
  <div class="row">
    <div class="col-xl-6">

      {{-- inizio ricerca --}}
      <form class="input-group mb-3 bool_form" method="post" enctype="multipart/form-data">
        {{-- @csrf
        @method('POST') --}}

        <label class="sr-only" for="">Ricerca un appartamento</label>
        <input id="input-map" type="search" class="form-control" class="form-control bool_input" placeholder="Dove vuoi andare" />

        {{-- SEARCH INFO --}}
        <input  id="latitude" type="text" name="latitude" value="">
        <input  id="longitude" type="text" name="longitude" value="">
        <input  id="city" type="text" name="city" value="">
        <input  id="region" type="text" name="region" value="">

        {{-- SUBMIT --}}
        <div class="input-group-append">
          <button class="btn btn-boolbnb" type="submit">Cerca</button>
        </div>

      </form>
      {{-- fine ricerca --}}


      {{-- inizio filtri di ricerca --}}
      <a class="bool_filter" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        Filtri di ricerca
      </a>


      <div class="collapse bool_dropdown" id="navbarToggleExternalContent">

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
            <label for="rooms">Distanza:</label>
            <input type="range" class="bool_slider" id="radius" min="20" max="40" step="10" value="20">
            <span id="radius-value"></span>
          </div>
        </div>

        {{-- Services --}}
        <div class="services-box">
          <?php $i = 0; ?>
          @foreach ($services as $service)
          <?php $count = $i+=1?>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="services[]" value="{{$service->id}}" class="custom-control-input"  id="<?php echo 'customCheck'. $count ?>">
            <label class="custom-control-label"  for="<?php echo 'customCheck'. $count ?>"><span class="bool_icon">{!! $service->icon !!}</span> {{$service->name}} </label>
          </div>
          @endforeach
        </div>

      </div>
      {{-- fine filtri di ricerca --}}

      {{-- inizio lista appartamenti --}}
      <div class="all-apartments-container">
        @if (!$apartments->isEmpty())
          <ul>
            @foreach ($apartments as $apartment)
              <li class="bool_ap">

                  {{-- Immagine --}}
                  @if (!empty($apartment->main_img))
                    <div class="bool_img_apt">
                      <a href="{{route('guest.apartments.show', $apartment)}}">
                        @if (strpos($apartment->main_img,'mpixel'))
                          <img src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                        @else
                          <img src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
                        @endif
                      </a>
                    </div>
                  @else
                    <div class="bool_img_apt">
                      <a href="{{route('guest.apartments.show', $apartment)}}">
                        <img src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                      </a>
                    </div>
                  @endif

                  {{-- Informazioni --}}
                  <div class="bool_info_apt">
                    <a href="{{route('guest.apartments.show', $apartment)}}">
                      <p class="bool_info_text">Intero appartamento a {{$apartment->city}}, {{$apartment->region}}</p>
                      <h4>{{$apartment->title}}</h4>
                      <hr>
                      <p class="bool_info_text">{{$apartment->num_beds}} ospiti - {{$apartment->num_rooms}} camere da letto - {{$apartment->num_baths}} bagni</p>

                      @if (!$apartment->services->isEmpty())
                        @foreach ($apartment->services as $service)
                          <span class="bool_info_text">&#8901; {{$service->name}}</span>
                        @endforeach
                      @endif

                      <p class="bool_price">Prezzo: {{$apartment->price}} € <small>/ a notte</small> </p>
                    </a>
                  </div>

              </li>

            @endforeach
          </ul>
        @endif
        {{-- fine lista appartamenti --}}

        <div class="bool_pagination">
            {{$apartments->links()}}
        </div>
      </div>


    </div> <!-- end col-xl-6 -->
    {{-- fine colonna sinistra con appartamenti e ricerca --}}

    {{-- inizio colonna destra con mappa --}}
    <aside class="col-xl-6 bool_map_col">
      <div class="ricerca">
      </div>
      <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
      <div class="bool_map_container">
        <div id="map-example-container"></div>
        {{-- <img src="{{asset('img/guest/mappa_ricerca.png')}}" alt="Mappa"> --}}
      </div>

      <!-- ================================================================  -->
      <!-- ===================== SCRIPT ===================================  -->
      <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>

    </aside>
    {{-- fine colonna destra con mappa --}}

  </div>
</section>
{{-- fine sezione appartamenti e mappa --}}
<script src="{{asset('js/boolbnb/guest/index.js')}}"></script>
@endsection
