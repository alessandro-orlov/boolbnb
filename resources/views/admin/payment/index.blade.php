@extends('layouts.app')

@section('content')
  @if ($end_date < $now || $end_date == false)

    <section>
      <div class="container py-5">

        <h1 class="edit-apartment-title">{{$apartment->title}}</h1>

        <div class="apartment-edit-container">
          <div class="row">

            {{-- LEFT SIDE --}}
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

            {{-- RIGHT SIDE --}}
            <div class="col-md-7 col-sm-12 form-container">
                <h2>Dai una maggiore visibilità al tuo appartamento!</h2>
                <div class="sponsorships-names my-4">
                  <h3 style="color:red">Basic</h3>
                  <p>
                    Metti in evidenza il tuo appartamento per <span class="font-weight-bold">1</span> giorno al costo di <span class="font-weight-bold">2.99 €</span>
                  </p>
                  <h3 style="color:red">Advanced</h3>
                  <p>
                    Metti in evidenza il tuo appartamento per <span class="font-weight-bold">3</span> giorni al costo di <span class="font-weight-bold">5.99 €</span>
                  </p>
                  <h3 style="color:red">Premium</h3>
                  <p>
                    Metti in evidenza il tuo appartamento per <span class="font-weight-bold">6</span> giorni al costo di<span class="font-weight-bold"> 9.99 €</span>
                  </p>
                </div>


                {{-- FORM --}}
                <form method="post" id="payment-form" autocomplete="off" action="{{ route('admin.payment.checkout', $apartment) }}">
                @csrf
                @method('POST')

                  {{-- SELECT SPONSORSHIP --}}
                  <label class="sr-only">Seleziona la sponsorizzazione</label><br>
                  <select id="sponsorship_select" name="sponsorship_select" class="form-control">
                    <option>Seleziona la sponsorizzazione</option>
                    @foreach ($sponsorships as $sponsorship)
                        <option data-price="{{ $sponsorship->price }}" value="{{ $sponsorship->id }}">{{ $sponsorship->name }}</option>
                    @endforeach
                  </select>

                  {{-- PRICE --}}
                  <div class="text-right mt-5 sponsorship-price">
                    <label for="amount">
                      <span class="font-weight-bold boolbnb-red">Prezzo:</span>
                    </label>
                    <div class="">
                      <input class="text-right border-0 font-weight-bold" id="amount" name="amount" type="tel" min="1" value="" readonly> <span class="font-weight-bold">€</span>
                    </div>
                  </div>

                  {{-- CREDIT CARD --}}
                  <div id="dropin" class="mb-4"></div>

                  {{-- PAY BUTTON --}}
                  <div class="text-right">
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="btn btn-success" type="submit"><span>Paga ora</span></button>
                  </div>

                </form>

              @else
               @foreach ($apartment->sponsorships as $sponsorship)
                   <script src="{{asset('js/boolbnb/admin/payment/alert.js')}}"></script>
                   <a id='alert' href="#myModal" class="trigger-btn" data-toggle="modal" hidden>Click to Open Confirm Modal</a>
                   <!-- Modal HTML -->
                   <div id="myModal" class="modal fade">
                       <div class="modal-dialog modal-confirm">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h4 class="modal-title w-100">Attenzione!</h4>
                               </div>
                               <div class="modal-body">
                                   <p class="text-center">Hai già la sponsorizzazione "{{ $sponsorship->name }}" attiva. Scade il {{ $end_date }}</p>
                               </div>
                               <div class="modal-footer">
                                   <button onclick="history.back();" class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                               </div>
                           </div>
                       </div>
                   </div>
               @endforeach

            </div> {{-- END RIGHT SIDE--}}

          </div>
        </div>

      </div>
    </section>
    @endif
    <script src="{{asset('js/boolbnb/admin/payment/payment.js')}}"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
    <script>
      var form = document.querySelector('#payment-form');
      var client_token = "{{ $token }}";

      braintree.dropin.create({
          authorization: client_token,
          selector: '#dropin',

      }, function (createErr, instance) {
          if (createErr) {
              console.log('Create Error', createErr);
              return;
          }
          form.addEventListener('submit', function (event) {
              event.preventDefault();

              instance.requestPaymentMethod(function (err, payload) {
                  if (err) {
                      console.log('Request Payment Method Error', err);
                      return;
                  }

                  // Add the nonce to the form and submit
                  document.querySelector('#nonce').value = payload.nonce;
                  form.submit();
              });
          });
      });
    </script>
@endsection
