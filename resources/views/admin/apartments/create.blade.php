@extends('layouts.app')

@section('content')
  <div class="container">

      <div class="big-image" style="width: 100%; position:relative;">
          <img style="width: 100%; border-radius: 10px; margin-bottom: 50px;" src="{{asset('img/admin-office/add-host.jpg')}}" alt="">

          <div class="row">
              <div class="col-md-4 col-sm-12">
                  <h2>Perché affittare su Boolbnb? </h2>
                  <p>
                    Indipendentemente dal tipo di alloggio o stanza che vuoi condividere, <strong>Boolbnb</strong> rende semplice e sicuro ospitare dei viaggiatori. Spetta a te il controllo completo della disponibilità, dei prezzi, delle regole della casa e della modalità di interazione con gli ospiti.
                  </p>
              </div>
          </div>
          {{-- TODO: classe con SASS --}}
          <div class="col-md-7 col-sm-12" style="background-color: #fff; border-radius: 15px; padding: 20px 20px 50px; box-shadow: 0px 0px 15px 1px #0000002b; position: absolute; top: 25%; right: 5%; margin-bottom: 50px;">
            <h1>Diventa un host</h1>
            {{-- Errors - Validation Server side --}}
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
            <form class="needs-validation" novalidate action="{{ route('admin.apartments.store') }}" method="post">
            @csrf
            @method('POST')

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="title">Titolo</label>
                        <input type="title" class="form-control" name="title" value="{{ old('title') }}" placeholder="Inserisci il titolo" required>
                        <small id="emailHelp" class="form-text text-muted">Scrivi il titolo per il tuo alloggio</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Metri quadri</label>
                        <input type="number" name="mq" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Stanze</label>
                        <input type="number" name="num_rooms" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Letti</label>
                        <input type="number" name="num_beds" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Bagni</label>
                        <input type="number" name="num_baths" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Descrizione</label>
                        <textarea class="form-control" name="description" rows="7" required>{{ old('address') }}</textarea>
                    </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="title">Indirizzo</label>
                          <input type="title" class="form-control" name="address" value="{{ old('address') }}" placeholder="Inserisci l'indirizzo" required>
                          <small class="form-text text-muted">Digita il tuo indirizzo</small>
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="title">Prezzo a notte</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                              </div>
                                  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" >
                              <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label>Inserisci Immagini</label>
                      <input type="file" name="main_img" class="form-control-file">
                  </div>

                  <div class="form-row">
                      <div class="form-check col-md-12 text-right">
                          <input type="submit" class="btn btn-primary" value="Salva">
                      </div>
                  </div>
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
            </form>
          </div>
      </div>

  </div>

@endsection
