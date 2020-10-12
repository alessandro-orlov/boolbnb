  {{-- Appartamenti sponsorizzati --}}
  @if (!empty($sponsored_apartments))
    <div id="ms-sponsored-apartments">
      <ul>
        @foreach ($sponsored_apartments as $sponsored_apartment)
          <li class="bool_ap">

              <!-- Immagine -->
              @if (!empty($sponsored_apartment->main_img))
                <div class="bool_img_apt">
                  <span id="sponsored-content">sponsorizzato <i class="fas fa-medal"></i></span>
                  <a href="{{route('guest.apartments.show', $sponsored_apartment)}}">
                    @if (strpos($sponsored_apartment->main_img,'mpixel'))
                      <img src="{{$sponsored_apartment->main_img}}" alt="{{$sponsored_apartment->title}}">
                    @else
                      <img src="{{asset('storage').'/'.$sponsored_apartment->main_img}}" alt="{{$sponsored_apartment->title}}">
                    @endif
                  </a>
                </div>
              @else
                <div class="bool_img_apt">
                  <a href="{{route('guest.apartments.show', $sponsored_apartment)}}">
                    <img src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                  </a>
                </div>
              @endif

              <!-- Informazioni -->
              <div class="bool_info_apt">
                  <p class="bool_info_text">Intero appartamento a {{$sponsored_apartment->city}}, {{$sponsored_apartment->region}}</p>
                  <a href="{{route('guest.apartments.show', $sponsored_apartment)}}">
                    <h4>SPONSORED {{$sponsored_apartment->title}}</h4>
                  </a>
                  <hr>
                  <p class="bool_info_text">letti: {{$sponsored_apartment->num_beds}} - camere da letto: {{$sponsored_apartment->num_rooms}} - bagni: {{$sponsored_apartment->num_baths}}</p>

                  @if (!$sponsored_apartment->services->isEmpty())
                    @foreach ($sponsored_apartment->services as $service)
                      <span class="bool_info_text">&#8901; {{$service->name}}</span>
                    @endforeach
                  @endif

                  <p class="bool_price"><span>Prezzo: {{$sponsored_apartment->price}} € <small>/ a notte</small></span> </p>
              </div>
              <p class="d-none">
                <span class="latitude">{{$sponsored_apartment->latitude}}</span>
                <span class="longitude">{{$sponsored_apartment->longitude}}</span>
              </p>
          </li>

        @endforeach
      </ul>

    </div>
  @endif
