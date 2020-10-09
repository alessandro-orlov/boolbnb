@extends('layouts.app')

@section('title')
  Boolbnb - Chi siamo
@endsection

@section('content')
  <div class="container py-5">
    <div class="about-container">
      <div class="app-description">
        <h1>L'app</h1>
        <p>E' una riproduzione rivisitata di uno dei più famosi portali online che mette in contatto persone in cerca di un alloggio o di una camera per brevi periodi, con persone che dispongono di spazi extra da affittare, generalmente privati.</p>
        <h2>Funzionalità generali</h2>
        <h3><i class="fas fa-map-marker-alt"></i>Geolocalizzazione</h3>
        <p>Attraverso il software algolia è possibile geolocalizzare sulla mappa del territorio i vari appartamenti disponibili</p>
        <h3><i class="fas fa-user-cog"></i>Gestione appartamenti</h3>
        <p>Modifica e aggiorna gli appartamenti inseriti</p>
        <h3><i class="fas fa-comment-dots"></i>Messaggistica</h3>
        <p>Contatta i proprietari degli appartamenti da affittare</p>
        <h3><i class="fas fa-chart-bar"></i>Statistiche</h3>
        <p>Calcola quante visite ha ricevuto ogni appartamento con cadenza mensile, settimanale e giornaliera</p>
        <h3><i class="fas fa-star"></i>Sponsor</h3>
        <p>Possibilità di sponsorizzare uno o più appartamenti inseriti, per un certo periodo di tempo, in modo da aumentarne la visibilità</p>
        <h3><i class="fas fa-money-check-alt"></i></i>Pagamenti</h3>
        <p>Prenotazioni online in sicurezza grazie a Braintree</p>
      </div>
      <h1>I creatori</h1>
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <div class="box-about">
            <div class="picture">
              <a href="#">
                <img src="{{asset('img/malta_villa.jpg')}}" alt="">
              </a>
            </div>
            <div class="names">
              <h3>Alexander Orlov</h3>
              <p>Full-Stack</p>
              <p>
                <a href="#">
                  <i class="fab fa-linkedin"></i>
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="box-about">
            <div class="picture">
              <a href="#">
                <img src="{{asset('img/malta_villa.jpg')}}" alt="">
              </a>
            </div>
            <div class="names">
              <h3>Laura Storella</h3>
              <p>Back-End</p>
              <p>
                <a href="#">
                  <i class="fab fa-linkedin"></i>
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="box-about">
            <div class="picture">
              <a href="#">
                <img src="{{asset('img/malta_villa.jpg')}}" alt="">
              </a>
            </div>
            <div class="names">
              <h3>Marco Prosperi</h3>
              <p>Back-End</p>
              <p>
                <a href="#">
                  <i class="fab fa-linkedin"></i>
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="box-about">
            <div class="picture">
              <a href="#">
                <img src="{{asset('img/malta_villa.jpg')}}" alt="">
              </a>
            </div>
            <div class="names">
              <h3>Sara Cremonesi</h3>
              <p>Front-End</p>
              <p>
                <a href="#">
                  <i class="fab fa-linkedin"></i>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
