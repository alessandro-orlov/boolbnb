@extends('layouts.app')
@section('content')

{{-- inizio sezione appartamenti e mappa --}}
<section class="container-fluid bool_ap_results">

{{-- inizio colonna sinistra con appartamenti e ricerca --}}
  <div class="row">
    <div class="col-xl-6">

      {{-- inizio ricerca --}}
      <form class="input-group mb-3 bool_form">
        <label class="sr-only" for="">Ricerca un appartamento</label>
        <input type="text" class="form-control bool_input" placeholder="Dove vuoi andare?" aria-label="Recipient's username" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-boolbnb" type="button" id="button-addon2">Cerca</button>
        </div>
      </form>
      {{-- fine ricerca --}}


      {{-- inizio filtri di ricerca --}}
      <a class="bool_filter" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        Filtri di ricerca
      </a>

      <div class="collapse bool_dropdown" id="navbarToggleExternalContent">
        <?php $i = 0; ?>
        @foreach ($services as $service)
        <?php $count = $i+=1?>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="services[]" value="{{$service->id}}" class="custom-control-input"  id="<?php echo 'customCheck'. $count ?>">
          <label class="custom-control-label"  for="<?php echo 'customCheck'. $count ?>"><span class="bool_icon">{!! $service->icon !!}</span> {{$service->name}} </label>
        </div>
        @endforeach
      </div>
      {{-- fine filtri di ricerca --}}

      {{-- inizio lista appartamenti --}}
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
    {{-- fine colonna sinistra con appartamenti e ricerca --}}

    {{-- inizio colonna destra con mappa --}}
    <aside class="col-xl-6 bool_map_col">

      <div class="bool_map_container">
        <img src="{{asset('img/guest/mappa_ricerca.png')}}" alt="Mappa">
      </div>

    </aside>
    {{-- fine colonna destra con mappa --}}

  </div>
</section>
{{-- fine sezione appartamenti e mappa --}}


@endsection
