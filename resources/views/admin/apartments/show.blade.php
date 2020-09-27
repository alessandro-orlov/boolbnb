@extends('layouts.app')

@section('content')
  <div class="container py-5">
    {{-- Intestazione --}}
    <h1>{{$apartment->title}}</h1>
    {{-- Indirizzo --}}
    <div style="display:flex; justify-content:space-between;">
        <p style="line-height: 70px;">
            {{$apartment->address}}
        </p>
        <p style="line-height: 70px;">
            <b style="font-size:1.5em;">{{$apartment->price}}€ /a notte</b>
        </p>
    </div>

    {{-- Immagine --}}
    @if (!empty($apartment->main_img))
        <div class="img-container">
            @if (strpos($apartment->img_path,'lorempixel'))
                <img src="{{$apartment->img_path}}" alt="{{$apartment->title}}">
              @else
                  <img src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
            @endif
        </div>
    @endif

    {{-- Servizi --}}
    <div>
      <h3>Servizi</h3>
      {{-- Controllo !array->isEmpty() --}}
      @if (!$apartment->services->isEmpty())
        @foreach ($apartment->services as $service)
          <span>{{$service->name}}</span>
          <span>{!!$service->icon!!}</span>
        @endforeach
      @endif
    </div>

    {{-- Caratteristiche vari --}}
    <div class="apartment-specs" >
      <div class="row">
        <div class="left col-2">
          <h4>Specifiche</h4>
          <ul style="list-style:none; padding-left:0px;">

              <li style="display:flex; justify-content:space-between;">
                  <span>Stanze:</span> <span>{{$apartment->num_rooms}}</span>
              </li>

              <li style="display:flex; justify-content:space-between;">
                <span>Letti:</span> <span>{{$apartment->num_beds}}</span>
              </li>

              <li style="display:flex; justify-content:space-between;">
                  <span>Bagni:</span> <span>{{$apartment->num_baths}}</span>
              </li>

              <li style="display:flex; justify-content:space-between;">
                  <span>Mq:</span> <span>{{$apartment->mq}}</span>
              </li>
          </ul>
        </div>
        <div class="right col-8">
          <h4>Descrizione</h4>
          <p>
            {{$apartment->description}}
          </p>
        </div>
      </div>
      <div class="map-container">
          <h3>Posizione dell'appartamento</h3>
          <div class="row">
              <div class="col-12">
                <div class="marker-on-map" >
                    <input  type="search" id="input-map"/>
                    <input  type="text"  class="show-latitude" value="{{$apartment->latitude}}" />
                    <input  type="text"  class="show-longitude" value="{{$apartment->longitude}}" />
                </div>
                <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>

                <div id="map-example-container"></div>
              </div>
          </div>
      </div>




    </div>
  </div>
  <script src="{{asset('js/boolbnb/admin/show.js')}}"></script>
@endsection
