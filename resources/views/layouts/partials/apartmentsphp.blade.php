@if (!$apartments->isEmpty())

  {{-- Appartamenti sponsorizzati --}}
  @if (!empty($sponsored_apartments))
    <div id="ms-sponsored-apartments">
      <ul>
        @foreach ($sponsored_apartments as $sponsored_apartment)
          <li class="bool_ap">

              <!-- Immagine -->
              @if (!empty($sponsored_apartment->main_img))
                <div class="bool_img_apt">
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
                    <h4>{{$sponsored_apartment->title}}</h4>
                  </a>
                  <hr>
                  <p class="bool_info_text">{{$sponsored_apartment->num_beds}} ospiti - {{$sponsored_apartment->num_rooms}} camere da letto - {{$sponsored_apartment->num_baths}} bagni</p>

                  @if (!$sponsored_apartment->services->isEmpty())
                    @foreach ($sponsored_apartment->services as $service)
                      <span class="bool_info_text">&#8901; {{$service->name}}</span>
                    @endforeach
                  @endif
                  
                  <p class="bool_price"><span>Prezzo: {{$sponsored_apartment->price}} € <small>/ a notte</small></span> </p>
              </div>
              <span id="sponsored-content">sponsorizzato</span>
          </li>

        @endforeach
      </ul>

    </div>
  @endif


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
                <p class="bool_info_text">{{$apartment->num_beds}} ospiti - {{$apartment->num_rooms}} camere da letto - {{$apartment->num_baths}} bagni</p>

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

<div class="bool_pagination">
    {{$apartments->links()}}
</div>
