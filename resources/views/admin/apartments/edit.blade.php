@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <h1 class="boolbnb-primary-color edit-apartment-heading">Aggiorna l'appartamento</h1>
    <h2 class="edit-apartment-title">{{$apartment->title}}</h2>
    <div class="apartment-edit-container">
      <div class="row">
          <div class="col-md-5">
              <div class="edit-this-apartment">
                  {{-- Foto --}}
                  <div class="edit-apartment-foto">
                      @if (!empty($apartment->main_img))
                          @if (strpos($apartment->main_img,'mpixel'))
                              <img src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                            @else
                              <img src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
                          @endif
                      @else
                          <img src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                      @endif
                  </div>
                  {{-- Info --}}
                  <div class="edit-apartment-info">
                      <div class="edit-apartment-row">
                          <div class="edit-column left">Città</div>
                          <div class="edit-column right">{{$apartment->city}}</div>
                      </div>
                      <div class="edit-apartment-row">
                          <div class="edit-column left">Provincia</div>
                          <div class="edit-column right">{{$apartment->region}}</div>
                      </div>
                      <div class="edit-apartment-row">
                          <div class="edit-column left">Prezzo a notte</div>
                          <div class="edit-column right"> <span class="boolbnb-primary-color">{{$apartment->price}} €</span> </div>
                      </div>
                  </div>
              </div>
          </div>

          {{-- Form container --}}
          <div class="col-md-7 col-sm-12 form-container">
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
            {{-- FORM --}}
            <form class="needs-validation" novalidate action="{{ route('admin.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                {{-- Title --}}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="title">Titolo</label>
                        <input type="title" class="form-control" name="title" value="{{ old('title') ? old('title') : $apartment->title }}" placeholder="Inserisci il titolo" required>
                        <small id="emailHelp" class="form-text text-muted">Scrivi il titolo per il tuo alloggio</small>
                    </div>
                </div>

                {{-- Superfice & Stanze --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Superfice m<sup>2</sup></label>
                        <input type="number" name="mq" value="{{ old('mq') ? old('mq') : $apartment->mq }}" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Stanze</label>
                        <input type="number" name="num_rooms" value="{{ old('num_rooms') ? old('num_rooms') : $apartment->num_rooms }}" class="form-control" required>
                    </div>
                </div>

                {{-- Letti & Bagni --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Letti</label>
                        <input type="number" name="num_beds" value="{{ old('num_beds') ? old('num_beds') : $apartment->num_beds }}" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Bagni</label>
                        <input type="number" name="num_baths" value="{{ old('num_baths') ? old('num_baths') : $apartment->num_baths }}" class="form-control" required>
                    </div>
                </div>

                {{-- Checkboxes Servizi --}}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Servizi</label>
                        <div class="row">

                            <?php $i = 0; ?>
                            @foreach ($services as $service)
                                <?php $count = $i+=1?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="custom-control custom-checkbox">

                                        <input type="checkbox" name="services[]" {{ $apartment->services->contains($service) ? 'checked' : '' }} value="{{$service->id}}" class="custom-control-input"  id="<?php echo 'customCheck'. $count ?>">

                                        <label class="custom-control-label"  for="<?php echo 'customCheck'. $count ?>">{{$service->name}} <span class="service-icon">{!! $service->icon !!}</span></label>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- Descrizione --}}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Descrizione</label>
                        <textarea class="form-control" name="description" rows="7" required>{{ old('description') ? old('description') : $apartment->description }}</textarea>
                    </div>
                </div>

                {{-- Indirizzo --}}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="title">Indirizzo</label>
                        <input class="form-control" name="address" type="search" id="address-input" placeholder="Inserisci il nuovo l'indirizzo" required/>
                        <input hidden id="latitude" type="text" name="latitude" value="">
                        <input hidden id="longitude" type="text" name="longitude" value="">
                        <input hidden id="city" type="text" name="city" value="">
                        <input hidden id="region" type="text" name="region" value="">
                        <small class="form-text text-muted">{{$apartment->address}}</small>
                    </div>
                </div>

                {{-- API ADRESS --}}
                <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
                <script>
                    var placesAutocomplete = places({
                      appId: 'plAQEOVDX808',
                      apiKey: '5e56964f06ab40f6c0d1912086c2be09',
                      container: document.querySelector('#address-input')
                    });
                    var $address = document.querySelector('#address-value')
                       placesAutocomplete.on('change', function(e) {
                        document.querySelector("#latitude").value = e.suggestion.latlng.lat || "";
                        document.querySelector("#longitude").value = e.suggestion.latlng.lng || "";
                        document.querySelector("#city").value = e.suggestion.city || "";
                        document.querySelector("#region").value = e.suggestion.administrative || "";
                      });
                      placesAutocomplete.on('clear', function() {
                        $address.textContent = 'none';
                      });
                </script>

                {{-- Prezzo a notte --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Prezzo a notte</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">€</span>
                            </div>
                                <input type="text" name="price" value="{{ old('price') ? old('price') : $apartment->price }}" class="form-control" aria-label="Amount (to the nearest dollar)" >
                        </div>
                          {{-- <div class="edit-price-error">Puoi inserire solo numeri interi!</div> --}}
                    </div>
                </div>

                {{-- Prezzo a notte --}}
                {{-- <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="title">Prezzo a notte</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                                <input type="text" name="price" value="{{ old('price') }}" class="form-control" aria-label="Amount (to the nearest dollar)" >
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- Image upload --}}
                <div class="form-group">
                    <label>Inserisci Immagini</label>
                    <input type="file" name="main_img" accept="image/*" class="form-control-file">
                    {{-- <input type="file" name="img_path" accept="image/*"> --}}
                </div>

                {{-- Submit --}}
                <div class="form-row">
                    <div class="form-check col-md-12 text-right">
                        <input type="submit" class="btn btn-boolbnb" value="Aggiorna l'appartamento">
                    </div>
                </div>

                {{-- Validazione Client side --}}
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
      </div> <!-- row-->
    </div> <!-- apartment-edit -->
  </div> <!-- main conatiner-->
  <script src="{{asset('js/boolbnb/admin/edit.js')}}"></script>

@endsection
