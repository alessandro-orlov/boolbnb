@extends('layouts.app')

@section('content')
  <div class="container">

      <h1>Add apartment</h1>

      {{-- Errors --}}
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

      <div class="row">
          <div class="col-md-4 col-sm-12">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
          </div>
          <div class="col-md-8 col-sm-12">
            <form action="{{'admin.apartments.store'}}" method="post">
                @csrf
                @method('POST')

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="title">Titolo</label>
                        <input type="title" class="form-control" name="title" value="{{ old('title') }}" placeholder="Inserisci il titolo">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">Metri quadri</label>
                        <input type="number" name="mq" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">Stanze</label>
                        <input type="number" name="num_rooms" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">Letti</label>
                        <input type="number" name="num_beds" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">Bagni</label>
                        <input type="number" name="num_baths" class="form-control">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Descrizione</label>
                        <textarea class="form-control" name="description" rows="10">{{ old('address') }}</textarea>
                    </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-8">
                          <label for="title">Indirizzo</label>
                          <input type="title" class="form-control" name="address" value="{{ old('address') }}" placeholder="Inserisci l'indirizzo">
                          <small class="form-text text-muted">Digita il tuo indirizzo</small>
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-8">
                          <label for="title">Prezzo a notte</label>
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                              </div>
                                  <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                              <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="form-check col-md-8 text-right">
                          <input type="submit" class="btn btn-primary" value="Salva">
                      </div>
                  </div>



            </form>
          </div>
      </div>
  </div>

@endsection
