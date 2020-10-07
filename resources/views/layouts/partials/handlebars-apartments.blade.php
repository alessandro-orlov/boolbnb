<li class="bool_ap">
    {{-- Immagine --}}
    <div class="bool_img_apt">
      <a href="/guest/apartments/@{{id}}">
        <img src="@{{main_img}}" alt="@{{title}}">
      </a>
    </div>

    {{-- Informazioni --}}
    <div class="bool_info_apt">
        <p class="bool_info_text">Intero appartamento a @{{city}}, @{{region}}</p>
        <h4><a href="/guest/apartments/@{{id}}">@{{title}}</a></h4>
        <hr>
        <p class="bool_info_text">@{{num_beds}} ospiti - @{{num_rooms}} camere da letto - @{{num_baths}} bagni</p>
        <p class="bool_price"><span>Prezzo: @{{price}} € <small>/ a notte</small> <span></p>
        <p class="latlng-hidden">
          <span class="latitude">@{{latitude}}</span>
          <span class="longitude">@{{longitude}}</span>
        </p>
    </div>
    <span id="sponsored-content">sponsorizzato</span>
</li>
{{-- fine lista appartamenti --}}
