@extends('layouts.app')

@section('content')
  {{-- begin jumbotron --}}
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <h1>Riscopri l'Italia</h1>
        <h2>Cambia quadro. Scopri alloggi nelle vicinanze tutti da vivere, per lavoro o svago.</h2>
        <button type="button" class="btn btn-boolbnb">Esplora i dintorni</button>
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
              <img src="{{asset('img/american_house.jpg')}}" alt="">
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
              <img src="../public/img/baita.jpg" alt="">
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
              <img src="../public/img/american_house.jpg" alt="">
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
              {{-- <img src="../public/img/american_house.jpg" alt=""> --}}
            </div>
            <div class="text">
              <h4></h4>
              <p></p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              {{-- <img src="../public/img/american_house.jpg" alt=""> --}}
            </div>
            <div class="text">
              <h4></h4>
              <p></p>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="box">
            <div class="image">
              {{-- <img src="../public/img/american_house.jpg" alt=""> --}}
            </div>
            <div class="text">
              <h4></h4>
              <p></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end homepage --}}
@endsection
