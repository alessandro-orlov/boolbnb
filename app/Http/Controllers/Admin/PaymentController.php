<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Apartment;
use App\Sponsorship;
use Braintree\Gateway;
use Carbon\Carbon;

class PaymentController extends Controller
{
  public function index(Apartment $apartment){

    $sponsorships = Sponsorship::all();


      $now = Carbon::now();
      $expiration = false;
      $end_date = false;
      if (count((array)$apartment->sponsorships) != 0) {
          foreach ($apartment->sponsorships as $sponsorship) {
            $end_date = $sponsorship->pivot->end_date;
            if ($end_date < $now) {
              $apartment->sponsorships()->detach($sponsorship);
            }
          }
        $carbon_end_date = new Carbon($end_date);
        $expiration = $carbon_end_date->format('d-m-y');
      }


      $gateway = new Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
      ]);

      $token = $gateway->ClientToken()->generate();

      return view('admin.payment.index', compact('token', 'apartment', 'sponsorships', 'expiration' , 'now' ,'end_date'));
  }

  public function checkout(Request $request, Apartment $apartment){

    $gateway = new Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;
    $sponsorship = $request->sponsorship_select;


    $this_sponsorship = Sponsorship::where('id', $sponsorship)->first();
    $sponsorship_price = $this_sponsorship->price;

    if ($sponsorship_price != $amount) {
        die('Errore, questo non è il prezzo per la sponsorizzazione');
    }

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success || !is_null($result->transaction)) {
      $transaction = $result->transaction;

      if (isset($sponsorship)) {
        $expiration_sponsorship = Carbon::now('Europe/Rome')->addHours($this_sponsorship->end_date);

        $apartment->sponsorship()->attach($sponsorship, [
          'end_date' => $expiration_sponsorship,
          'start_date' => Carbon::now('Europe/Rome'),
        ]);
      }

      return redirect()->route('admin.apartments', compact('apartment'));
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }
        return redirect()->route('admin.apartments.index', compact('apartment'));
      }
  }

  public function transaction(Apartment $apartment){
    return view('admin.payment.transaction', compact('apartment'));
  }

}
