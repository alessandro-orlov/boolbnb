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
