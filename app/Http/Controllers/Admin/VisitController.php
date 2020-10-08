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
      // Carbon::now
      $today = Carbon::now();
      // dd($today);
      // $currentYear = Carbon::now()->year;
      // // dd($currentYear);
      // $currentMonth = Carbon::now()->month;
      // dd($currentMonth);
      // $currentDay = Carbon::now()->day;
      // dd($currentDay);

      // Carbon::today
      $currentDate = Carbon::today();
      // dd($currentDate);
      $currentYear = Carbon::today()->year;
      // dd($currentYear);
      $currentMonth = Carbon::today()->month;
      // dd($currentMonth);
      $currentDay = Carbon::today()->day;
      // dd($currentDay);
      $fullDay = $currentYear . '-' . $currentMonth . '-' . $currentDay;
      // dd($fullDay);

      // Carbon -- Giorni settimana
      // $todayDay= Carbon::now()->format('l');
      // dd($todayDay);
      


      // ---------------- Statistiche Annuali
      $startYear = Carbon::createFromDate($currentYear, 1, 1);
      $endYear = $currentYear . '-12-31';
      // dd($endYear);

      $thisYear = views($apartment)
            ->period(Period::create($startYear, $endYear))
            ->count();
      // dd($thisYear);

      
      // ----------------- Statistiche Ultimo Trimestre
      $pastTrimester = views($apartment)
             ->period(Period::pastMonths(3))
             ->remember()
             ->count();
      // dd($pastTrimester);


      // ----------------- Statistiche Ultimo Semestre
      $pastSemester = views($apartment)
             ->period(Period::pastMonths(6))
             ->remember()
             ->count();
      // dd($pastSemester);
      

      // ----------------- Statistiche Mensili 
      // Gennaio
      $startJan = Carbon::createFromDate($currentYear, 1, 1);
      $endJan = $currentYear . '-1-31';

      $january = views($apartment)
            ->period(Period::create($startJan, $endJan))
            ->count();

      // Febbraio
      $startFeb = Carbon::createFromDate($currentYear, 2, 1);
      $endFeb = $currentYear . '-2-28';
      
      $february = views($apartment)
            ->period(Period::create($startFeb, $endFeb))
            ->count();

      // Marzo
      $startMar = Carbon::createFromDate($currentYear, 3, 1);
      $endMar = $currentYear . '-3-31';
      
      $march = views($apartment)
            ->period(Period::create($startMar, $endMar))
            ->count();

      // Aprile
      $startApr = Carbon::createFromDate($currentYear, 4, 1);
      $endApr = $currentYear . '-4-30';
      
      $april = views($apartment)
            ->period(Period::create($startApr, $endApr))
            ->count();

      // Maggio
      $startMay = Carbon::createFromDate($currentYear, 5, 1);
      $endMay = $currentYear . '-5-31';
      
      $may = views($apartment)
            ->period(Period::create($startMay, $endMay))
            ->count();

      // Giugno
      $startJun = Carbon::createFromDate($currentYear, 6, 1);
      $endJun = $currentYear . '-6-30';
      
      $june = views($apartment)
            ->period(Period::create($startJun, $endJun))
            ->count();

      // Luglio
      $startJul = Carbon::createFromDate($currentYear, 7, 1);
      $endJul = $currentYear . '-7-31';
      
      $july = views($apartment)
            ->period(Period::create($startJul, $endJul))
            ->count();

      // Agosto
      $startAug = Carbon::createFromDate($currentYear, 8, 1);
      $endAug = $currentYear . '-8-31';
      
      $august = views($apartment)
            ->period(Period::create($startAug, $endAug))
            ->count();

      // Settembre
      $startSep = Carbon::createFromDate($currentYear, 9, 1);
      $endSep = $currentYear . '-9-30';
      
      $september = views($apartment)
            ->period(Period::create($startSep, $endSep))
            ->count();

      // Ottobre
      $startOct = Carbon::createFromDate($currentYear, 10, 1);
      $endOct = $currentYear . '-10-31';
      
      $october = views($apartment)
            ->period(Period::create($startOct, $endOct))
            ->count();

      // Novembre
      $startNov = Carbon::createFromDate($currentYear, 11, 1);
      $endNov = $currentYear . '-11-30';
      
      $november = views($apartment)
            ->period(Period::create($startNov, $endNov))
            ->count();

      // Dicembre
      $startDec = Carbon::createFromDate($currentYear, 12, 1);
      $endDec = $currentYear . '-12-31';
      
      $december = views($apartment)
            ->period(Period::create($startDec, $endDec))
            ->count();


      // ----------------- Statistiche Giornaliere
      $thisDay = views($apartment)
              ->period(Period::since($fullDay))
              ->count();
            //   dd($thisDay);


      // ----------------- Statistiche Settimanali 
      //    --> Totali 
      $thisWeek = views($apartment)
             ->period(Period::pastWeeks(1))
             ->remember()
             ->count();
            //  dd($thisWeek);

      return view('admin.visits.show', compact('apartment', 'thisYear', 'pastTrimester', 'pastSemester', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', 'thisDay', 'thisWeek'));
  }
}
