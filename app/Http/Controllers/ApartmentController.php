<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class ApartmentController extends Controller
{
  public function index(){
    $apartments = Apartment::orderBy('created_at', 'desc')->paginate(5);
    $services = Service::all();

    return view('guest.apartments.index', [
      'apartments'=>$apartments,
      'services'=>$services,
    ]);
  }

  public function show(Apartment $apartment){
    return view('guest.apartments.show', compact('apartment'));
  }
}
