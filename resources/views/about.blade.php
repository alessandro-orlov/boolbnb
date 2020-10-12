@extends('layouts.app')

@section('title')
  Boolbnb - Chi siamo
@endsection

@section('content')
  <div class="container py-5">
    <div class="about-container">
      <div class="app-description">
        <h1>Boolbnb</h1>
        <p>
          Questa app è una riproduzione rivisitata di uno dei più famosi portali online che mette in contatto persone in cerca di un alloggio o di una camera per brevi periodi, con persone che dispongono di spazi extra da affittare, generalmente privati.<br>
          Gli utenti che vogliono mettere in affitto uno o più appartamenti si possono registrare alla piattaforma.<br>
          Gli utenti interessati ad un appartamento, utilizzando i filtri di ricerca, vedono una lista di possibili appartamenti e cliccando su ognuno possono vedere le informazioni nel dettaglio.<br>
          Una volta trovato l’appartamento desiderato, l’utente interessato può contattare l’utente proprietario per ulteriori informazioni, oppure possono effettuare online la prenotazione con pagamento attraverso carta di credito.<br>
          Inoltre, i proprietari di un appartamento possono decidere di pagare per sponsorizzare l’annuncio del proprio appartamento per fare in modo che sia maggiormente in evidenza.

        </p>
        <h2>Functionalities</h2>
        <div class="functionalities">
          <div>
            <h3><i class="fas fa-map-marker-alt"></i>Geolocalizzazione</h3>
            <p>Attraverso il software algolia è possibile geolocalizzare sulla mappa del territorio i vari appartamenti disponibili</p>
          </div>

          <div>
            <h3><i class="fas fa-user-cog"></i>Gestione appartamenti</h3>
            <p>Modifica e aggiorna gli appartamenti inseriti</p>
          </div>

          <div>
            <h3><i class="fas fa-comment-dots"></i>Messaggistica</h3>
            <p>Contatta i proprietari degli appartamenti da affittare</p>
          </div>

          <div>
            <h3><i class="fas fa-chart-bar"></i>Statistiche</h3>
            <p>Calcola quante visite ha ricevuto ogni appartamento con cadenza mensile, settimanale e giornaliera</p>
          </div>

          <div>
            <h3><i class="fas fa-star"></i>Sponsor</h3>
            <p>Possibilità di sponsorizzare uno o più appartamenti inseriti, per un certo periodo di tempo, in modo da aumentarne la visibilità</p>
          </div>

          <div>
            <h3><i class="fas fa-money-check-alt"></i></i>Pagamenti</h3>
            <p>Prenotazioni online in sicurezza grazie a Braintree</p>
          </div>
        </div>

      </div>
      <h2 class="creators-heading">Developed by</h2>
      <div class="creators">
        
          <div class="box-about">
            <a href="https://www.linkedin.com/in/alessandro-orlov/" target="_blank">
              <div class="creator-box">
                <div class="picture">
                    <img src="{{asset('img/alex.jpg')}}" alt="">
                </div>
                <div class="names">
                    <h3>Alessandro Orlov</h3>
                    <p>Full-Stack</p>
                    <p><i class="fab fa-linkedin"></i></p>
                </div>
              </div>
            </a>
          </div>
          <div class="box-about">
            <a href="https://www.linkedin.com/in/laurastorella/" target="_blank">
              <div class="creator-box">
                <div class="picture">
                    <img src="{{asset('img/laura.jpg')}}" alt="">
                </div>
                <div class="names">
                    <h3>Laura Storella</h3>
                    <p>Back-End</p>
                    <p><i class="fab fa-linkedin"></i></p>
                </div>
              </div>
            </a>
          </div>
          <div class="box-about">
            <a href="https://www.linkedin.com/in/marcoprosperi/" target="_blank">
              <div class="creator-box">
                <div class="picture">
                    <img src="{{asset('img/marco.jpg')}}" alt="">
                </div>
                <div class="names">
                    <h3>Marco Prosperi</h3>
                    <p>Back-End</p>
                    <p><i class="fab fa-linkedin"></i></p>
                </div>
              </div>
            </a>
          </div>
          <div class="box-about">
            <a href="https://www.linkedin.com/in/sara-cremonesi-jr-dev/" target="_blank">
              <div class="creator-box">
                <div class="picture">
                    <img src="{{asset('img/sara.jpg')}}" alt="">
                </div>
                <div class="names">
                    <h3>Sara Cremonesi</h3>
                    <p>Front-End</p>
                    <p><i class="fab fa-linkedin"></i></p>
                </div>
              </div>
            </a>
          </div>

      </div>
    </div>
  </div>
@endsection
