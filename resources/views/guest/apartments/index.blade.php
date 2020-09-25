@extends('layouts.app')
@section('content')

{{-- inizio sezione ricerca --}}
<section class="container">
  <div class="row bool_row">
    <div class="col-sm-12 col-lg-8 offset-lg-2 ">

      <form class="input-group mb-3">
        <label class="sr-only" for="">Ricerca un appartamento</label>
        <input type="text" class="form-control" placeholder="Dove vuoi andare?" aria-label="Recipient's username" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cerca</button>
        </div>
      </form>

    </div>
  </div>

  <div class="row">
    <div class="col-md-10 offset-md-1 col-lg-10 offset-lg-1 bool_filters">

      <h4 class="text-center">Filtri di ricerca</h4>
      <div class="row">
        <div class="col-sm-12 ">

          <ul class="list-group list-group-horizontal">
            @foreach ($services as $service)
              <li class="bool_filters_li">
                <input type="checkbox" name="services[]" value="{{$service->id}}" >
                <span>{!!$service->icon!!}</span>
                <span>{{$service->name}}</span>
              </li>
            @endforeach
          </ul>

        </div>
      </div>

    </div>
  </div>
</section>
{{-- fine sezione ricerca --}}

{{-- inizio sezione appartamenti --}}
<section class="container-fluid bool_ap_results">

{{-- inizio colonna sinistra con appartamenti --}}
  <div class="row">
    <div class="col-lg-6">

      @if (!$apartments->isEmpty())
        <ul>
          @foreach ($apartments as $apartment)
            <li class="bool_ap">

              <div class="bool_infos">

                <div class="bool_img_apt">
                  <a href="{{route('apartments.show', $apartment)}}">
                    <img src="{{$apartment->main_img}}" alt="Immagine principale dell'appartamento">
                  </a>
                </div>

                <div class="bool_info_apt">
                  <a href="{{route('apartments.show', $apartment)}}">
                    <h4>{{$apartment->title}}</h4>
                    <p>{{$apartment->description}}</p>
                  </a>
                </div>

              </div>

            </li>
          @endforeach
        </ul>
      @endif

    </div>
    {{-- fine colonna sinistra con appartamenti --}}

    {{-- inizio colonna destra con mappa --}}
    <aside class="col-lg-6 bool_map_col">

      <div class="bool_map_container">
        <img src="{{asset('img/guest/mappa_ricerca.png')}}" alt="Mappa">
      </div>

    </aside>
  </div>
</section>
{{-- fine sezione appartamenti --}}

@endsection
