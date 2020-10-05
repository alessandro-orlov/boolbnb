<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use CyrildeWit\EloquentViewable\Support\Period;
use Carbon\Carbon;

class VisitController extends Controller
{
  public function show(Apartment $apartment)
  {
      // Gennaio
      $startGennaio = Carbon::createFromDate(2020, 1, 1);
      $endGennaio = '2020-12-31';

      $gennaio2020 = views($apartment)
            ->period(Period::create($startGennaio, $endGennaio))
            ->count();

      // // Febbraio
      // $startFebbaraio = Carbon::createFromDate(2020, 1, 1);
      // $endFebbaraio = '2020-12-31';
      //
      // $gennaio2020 = views($apartment)
      //       ->period(Period::create($startDateTime, $endDateTime))
      //       ->count();

      return view('admin.visits.show', compact('apartment', 'gennaio2020', ));
  }
}
