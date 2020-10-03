<ul>

    <li class="bool_ap">

        {{-- Immagine --}}
        @if (!empty('@{{main_img}}'))
          <div class="bool_img_apt">
            <a href="http://127.0.0.1:8000/guest/apartments/@{{id}}">
              @if (strpos( '@{{main_img}}','mpixel'))
                <img src="@{{main_img}}" alt="@{{title}}">
              @else
                <img src="{{asset('storage')}}/@{{main_img}}" alt="@{{title}}">
              @endif
            </a>
          </div>
        @else
          <div class="bool_img_apt">
            <a href="http://127.0.0.1:8000/guest/apartments/@{{id}}">
              <img src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
            </a>
          </div>
        @endif

        {{-- Informazioni --}}
        <div class="bool_info_apt">
            <p class="bool_info_text">Intero appartamento a @{{city}}, @{{region}}</p>
            <h4><a href="http://127.0.0.1:8000/guest/apartments/@{{id}}">@{{title}}</a></h4>
            <hr>
            <p class="bool_info_text">@{{num_beds}} ospiti - @{{num_rooms}} camere da letto - @{{num_baths}} bagni</p>

            {{-- @if (!$apartment->services->isEmpty())
              @foreach ($apartment->services as $service)
                <span class="bool_info_text">&#8901; @{{$service->name}}</span>
              @endforeach
            @endif --}}

            <p class="bool_price"><span>Prezzo: @{{price}} € <small>/ a notte</small> <span></p>
            <p classe="latlng-hidden">
              <span class="latitude">@{{latitude}}</span>
              <span class="longitude">@{{longitude}}</span>
            </p>
        </div>
    </li>

  {{-- @endforeach --}}
</ul>
{{-- @endif --}}
{{-- fine lista appartamenti --}}

<div class="bool_pagination">
  {{-- {{$apartments->links()}} --}}
</div>
