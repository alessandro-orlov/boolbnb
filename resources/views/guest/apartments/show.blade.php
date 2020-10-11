@extends('layouts.app')

@section('content')

  @if(session('success'))
    <div id="message-send-success">
        <h3>{{session('success')}}</h3>
        <span id=icon><i class="fas fa-times"></i></span>
    </div>
  @endif

    {{-- Layout --}}
    <div class="container py-4">
        <div class="show-page-wrapper">
            {{-- Intestazione --}}
            <div class="show-top-heading">
                <h1>{{$apartment->title}}</h1>
                <h5><span class="icon"><i class="fas fa-map-marker-alt"></i></span> {{$apartment->city}}, {{$apartment->region}}</h5>
            </div>

            {{-- Show body --}}
            <div class="show-body">

                <div class="apartment-info">
                    {{-- Image container --}}
                    <div class="show-image-container">
                        <div class="main-image">
                            {{-- Immagine --}}
                            @if (!empty($apartment->main_img))
                                @if (strpos($apartment->main_img,'mpixel'))
                                    <img class="img-thumbnail" src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                                  @else
                                    <img class="img-thumbnail" src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
                                @endif
                            @else
                                <img class="img-thumbnail" src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                            @endif
                        </div>
                    </div>
                    {{-- END Image container --}}

                    <div class="general-info">
                        <h3>Informazioni generali</h3>
                        <p>
                          {{$apartment->mq}} m&sup2; <span class="divider">&bull;</span>
                          letti: {{$apartment->num_beds}} <span class="divider">&bull;</span>
                          stanze: {{$apartment->num_rooms}} <span class="divider">&bull;</span>
                          bagni: {{$apartment->num_baths}}
                        </p>
                        <p class="price-block">
                          <span>Prezzo a notte:</span> <span class="price">{{$apartment->price}} €</span>
                        </p>
                    </div>
                    <div class="description">
                        <h3>Descrizione</h3>
                        <p>
                          {{$apartment->description}}
                        </p>
                    </div>
                    <div class="apartment-services">
                        <h3>Servizi</h3>
                        <div class="services-container">
                            @if (!$apartment->services->isEmpty())
                                @foreach ($apartment->services as $service)
                                  <div class="service">
                                      <span class="icon">{!!$service->icon!!}</span>
                                      <span class="name">{{$service->name}}</span>
                                  </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                {{-- SE L'user è il proprietario dell'appartamento --}}
                @if($user != null && $user->id == $apartment->user_id)
                    <div class="contact-owner-container">
                        <div class="contact-owner-form">

                            {{-- Calcolo il numero di messaggi ricevuti --}}
                            @php
                              $array_msg = [];
                              foreach ($apartment->messages as $messages) {
                                $array_msg[] = $messages->apartment_id;
                              }
                              $this_apartment_messages = count($array_msg);
                            @endphp

                            <h2>Messaggi ricevuti: <span class="msg-count"><?php echo $this_apartment_messages ?></span></h2>
                            <div class="this-apartment">
                                <div class="text">
                                    {{$user->name}} visualizza i messaggi ricevuti per: <span class="title">{{$apartment->title}}</span>
                                </div>
                                <div class="link">
                                    <a href="{{route('admin.message.show', $apartment)}}">
                                      <div class="this-apartment-icons">
                                          <i class="far fa-envelope"></i>
                                      </div>
                                      <span>Visualizza</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="contact-owner-container">
                        <div class="contact-owner-form">
                            <h2>Contatta l'host</h2>
                            <div class="errors">
                              @if ($errors->any())
                                  <div class="alert alert-danger">
                                    <ul>
                                      @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                      @endforeach
                                    </ul>
                                  </div>
                                @endif
                            </div>
                            {{-- FORM --}}
                            <form class="needs-validation" id="send-message-to-host" novalidate action="{{ route('guest.apartments.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                                {{-- Message Title --}}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="titolo">Oggetto</label>
                                        <input type="text" class="form-control" name="msg_title" value="{{old('msg_title')}}" placeholder="Inserisci l'oggetto del messaggio" required>
                                    </div>
                                </div>
                                {{-- Sender name --}}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="nome">Il tuo nome</label>
                                        <input type="text" class="form-control" name="sender_name" value="{{old('sender_name')}}" placeholder="Inserisci il tuo nome" required>
                                    </div>
                                </div>
                                {{-- Sender email --}}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email">La tua email</label>
                                        <input type="email" class="form-control" name="sender_mail" value="{{old('sender_mail')}}" placeholder="Inserisci la tua email" required>
                                    </div>
                                </div>
                                {{-- message --}}
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="messaggio">Messaggio</label>
                                        <textarea class="form-control" name="message" rows="5" placeholder="Inserisci il tuo messaggio" required></textarea>
                                    </div>
                                </div>
                                {{-- Submit --}}
                                <div class="form-row">
                                    <div class="form-check col-md-12 text-right">
                                        <input hidden type="text" name="apartment_id" value="{{$apartment->id}}">
                                        <input type="submit"  class="btn btn-boolbnb" value="Invia il messaggio">
                                    </div>
                                </div>
                            </form>
                            <script>
                              // Form valdation
                              (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                  var forms = document.getElementsByClassName('needs-validation');
                                  // Loop over them and prevent submission
                                  var validation = Array.prototype.filter.call(forms, function(form) {
                                    form.addEventListener('submit', function(event) {
                                      if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                      }
                                      form.classList.add('was-validated');
                                    }, false);
                                  });
                                }, false);
                              })();
                            </script>
                        </div>
                    </div>
                    {{-- End FORM --}}
                @endif

            </div>
            {{-- End show body --}}

            {{-- MAP --}}
            <div class="show-map-container">
                <h3>Posizione</h3>
                <h5>{{$apartment->address}}</h5>
                <div class="row">
                    <div class="col-12">
                      <div class="marker-on-map" >
                          <input hidden type="search" id="input-map"/>
                          <input hidden type="text"  class="show-latitude" value="{{$apartment->latitude}}" />
                          <input hidden type="text"  class="show-longitude" value="{{$apartment->longitude}}" />
                      </div>
                      <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
                      <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>

                      <div id="map-example-container"></div>
                    </div>
                </div>
            </div>
            {{-- END MAP --}}
        </div>
    </div>
    {{-- End Layout --}}

  <script src="{{asset('js/boolbnb/guest/show.js')}}"></script>
@endsection
