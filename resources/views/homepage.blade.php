@extends('layouts.app')

@section('content')
  {{-- begin jumbotron --}}
  <div class="jumbotron">
    <div class="filter">
      <div class="container">
        <h1>Riscopri l'Italia</h1>
        <h2>Cambia quadro. Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</h2>
        <div class="jumbo-search-bar">
          <form action="{{url('api/search')}}" method="post">
                @csrf
                @method('GET')
                <div class="form-group">

                    <div class="where-bar">
                      <input type="search" id="address" name="address" placeholder="Dove vuoi andare?">
                      <input type="hidden" id="lat" name="lat" class="form-control">
                      <input type="hidden" id="lng" name="lng" class="form-control">
                    </div>
                    <div class="search-button">
                      <button type="button" class="btn btn-boolbnb">
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
