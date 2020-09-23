<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
  public function index(){
    $apartments = Apartment::all();
    return view('guest.apartments.index', compact('apartments'));
  }

  public function show(Apartment $apartment){
    return view('guest.apartments.show', compact('apartment'));
  }
}
