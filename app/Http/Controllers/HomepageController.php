<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use Carbon\Carbon;

class HomepageController extends Controller
{
  public function index()
  {

    $apartments = Apartment::all();
    $services = Service::all();
    $now = Carbon::now('Europe/Rome');

    $sponsored_apartments = [];

    foreach ($apartments as $apartment) {
      if (count($apartment->sponsorships) != 0) {
          foreach ($apartment->sponsorships as $sponsorship) {
              $end_date = $sponsorship->pivot->end_date;
              if ($end_date > $now) {
                  $sponsored_apartments[] = $apartment;
              } elseif ($end_date < $now) {
                  $apartment->sponsorships()->detach($sponsorship);
              }
          }
      }
    }

    shuffle($sponsored_apartments);

    return view('homepage', [
      'apartments' => $apartments,
      'sponsored_apartments' => $sponsored_apartments,
    ]);
  }
}
