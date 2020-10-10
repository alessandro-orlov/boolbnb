@extends('layouts.app')

@section('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>
  <script>
  jQuery(document).ready(function($){
    $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      autoplay:true,
      autoplayTimeout:5000,
      autoplayHoverPause:true,
      responsive:{
        0:{
          items:1
        },
        685:{
          items:2
        },
        1040:{
          items:3
        },
        1440:{
          items:4
        }
      }
    })
  })
  </script>
  {{-- begin jumbotron --}}
  <div class="jumbotron">
    <div class="filter">
      <div class="container">
        <h1>Riscopri l'Italia</h1>
        <h2>Cambia quadro. Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</h2>
        <div class="jumbo-search-bar">
          <form action="{{ route('guest.apartments.index')}}" method="post">
                @csrf
                @method('GET')
                <div class="form-group">

                    <div class="where-bar">
                      <input type="search" id="address" name="address" placeholder="Dove vuoi andare?">
                      <input type="hidden" id="lat" name="lat" class="form-control">
                      <input type="hidden" id="lng" name="lng" class="form-control">
                    </div>
                    <div class="search-button">
                      <button type="submit" class="btn btn-boolbnb">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
                    <script>
                        (function() {
                            var placesAutocomplete = places({
                                appId: 'plAQEOVDX808',
                                apiKey: '5e56964f06ab40f6c0d1912086c2be09',
                                container: document.querySelector('#address')
                            });
                            var address = document.querySelector('#address-value')
                            placesAutocomplete.on('change', function(e) {
                                $('#address').val(e.suggestion.value);
                                $('#lat').val(e.suggestion.latlng.lat);
                                $('#lng').val(e.suggestion.latlng.lng);

                                console.log("latitudine: ", $('#lat').val());
                                console.log("longitudine: ", $('#lng').val());
                            });
                            placesAutocomplete.on('clear', function() {
                                //$address.textContent = 'none';
                                $('#address').val('');
                                $('#lat').val('');
                                $('#lng').val('');
                            });
                        })();
                    </script>
                </div>
            </form>


        </div>
      </div>
    </div>
  </div>
  {{-- end jumbotron --}}

  {{-- carousel --}}
  <div class="owl-carousel owl-theme mt-8">
    @if (!$apartments->isEmpty())
      @if (!empty($sponsored_apartments))
        @foreach ($sponsored_apartments as $sponsored_apartment)
          <div class="item">
            <!-- Immagine -->
            <div class="bool_card_img">
              @if (!empty($sponsored_apartment->main_img))
                  <a href="{{route('guest.apartments.show', $sponsored_apartment)}}">
                    @if (strpos($sponsored_apartment->main_img,'mpixel'))
                      <img class="card-img-top" src="{{$sponsored_apartment->main_img}}" alt="{{$sponsored_apartment->title}}">
                    @else
                      <img class="card-img-top" src="{{asset('storage').'/'.$sponsored_apartment->main_img}}" alt="{{$sponsored_apartment->title}}">
                    @endif
                  </a>
              @else
                  <a href="{{route('guest.apartments.show', $sponsored_apartment)}}">
                    <img class="card-img-top" src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                  </a>
              @endif
            </div>

            <!-- Informazioni -->
            <div class="card-body text-center">
                <div class="sponsored-apartment-title">
                    <a href="{{route('guest.apartments.show', $sponsored_apartment)}}"><h4>{{$sponsored_apartment->title}}</h4></a>
                </div>
                <div class="sponsored-apartment-position">
                    <i class="fas fa-map-marker-alt"></i>  <span>Intero appartamento a {{$sponsored_apartment->city}}, {{$sponsored_apartment->region}}</span>
                </div>
            </div>
          </div>
        @endforeach
      @endif
    @endif
  </div>
  {{-- fine carousel --}}

  {{-- begin homepage --}}
  <div class="card-section">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              <a href="#">
                <img src="{{asset('img/malta_villa.jpg')}}" alt="">
              </a>
            </div>
            <div class="text">
              <h4>Spazi unici</h4>
              <p>Molto più che semplici spazi dove trascorrere la notte</p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              <a href="#">
                <img src="{{asset('img/casa_giardino.jpg')}}" alt="">
              </a>
            </div>
            <div class="text">
              <h4>Esperienze online</h4>
              <p>Attività uniche che possiamo fare insieme, organizzate da host di tutto il mondo</p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              <a href="#">
                <img src="{{asset('img/tuscany_house.jpg')}}" alt="">
              </a>
            </div>
            <div class="text">
              <h4>Case intere</h4>
              <p>Alloggi privati e confortevoli, con tanto spazio indoor e all'aperto per amici e parenti</p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              <a href="#">
                <img src="{{asset('img/wood_house.jpg')}}" alt="">
              </a>
            </div>
            <div class="text">
              <h4>Into the wild</h4>
              <p>Dai libero sfogo alla tua voglia di esplorare e rilassati nel confort di una maison su misura per te</p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              <a href="#">
                <img src="{{asset('img/american_house.jpg')}}" alt="">
              </a>
            </div>
            <div class="text">
              <h4>Vacanze da sogno</h4>
              <p>Prenota le tue vacanze e parti per una nuova avventura</p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              <a href="#">
                <img src="{{asset('img/baita.jpg')}}" alt="">
              </a>
            </div>
            <div class="text">
              <h4>Relax e armonia</h4>
              <p>Regalati una piccola fuga di benessere per staccare dalla routine quotidiana</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end homepage --}}
@endsection
