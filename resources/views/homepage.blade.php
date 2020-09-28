@extends('layouts.app')

@section('content')
  {{-- begin jumbotron --}}
  <div class="jumbotron">
    <div class="filter">
      <div class="container">
        <h1>Riscopri l'Italia</h1>
        <h2>Cambia quadro. Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</h2>
        <div class="search-bar">

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
