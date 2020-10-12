@if (!$apartments->isEmpty())

  {{-- Appartamenti non sponsorizzati --}}
  <div id="ms-normal-apartments">
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

                <p class="bool_info_text">Intero appartamento a {{$apartment->city}}, {{$apartment->region}}</p>
                <a href="{{route('guest.apartments.show', $apartment)}}">
                    <h4>{{$apartment->title}}</h4>
                </a>
                <hr>
                <p class="bool_info_text">letti: {{$apartment->num_beds}} - camere da letto: {{$apartment->num_rooms}} - bagni: {{$apartment->num_baths}}</p>

                @if (!$apartment->services->isEmpty())
                  @foreach ($apartment->services as $service)
                    <span class="bool_info_text">&#8901; {{$service->name}}</span>
                  @endforeach
                @endif

                <p class="bool_price"><span>Prezzo: {{$apartment->price}} € <small>/ a notte</small></span> </p>

              <p class="latlng-hidden">
                <span class="latitude">{{$apartment->latitude}}</span>
                <span class="longitude">{{$apartment->longitude}}</span>
              </p>
            </div>

        </li>

      @endforeach
    </ul>
  </div>
@endif
{{-- fine lista appartamenti --}}
