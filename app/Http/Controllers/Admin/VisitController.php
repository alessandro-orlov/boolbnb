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

      // ========================================== //
      // ===== CALCOLO GIORNI DELLA SETTIMANA ===== //

      // ===== CALCOLO VISITE OGGI ===== //
      $thisDay = views($apartment)
              ->period(Period::since($fullDay))
              ->count();
            //   dd($thisDay);


      // === CALCOLO DELLE VISITE IERI === //
      $yesterday_calc = $currentDay - 1;

      $startYesterdayTime = strval($currentYear.'-'.$currentMonth.'-'.$yesterday_calc);
      $endYesterdayTime = strval($currentYear.'-'.$currentMonth.'-'.$currentDay);

      $yesterday = views($apartment)
            ->period(Period::create($startYesterdayTime, $endYesterdayTime))
            ->count();
      // dd($yesterday);


      // === CALCOLO DELLE VISITE 2 GG fa ===  //
      $two_days_calc = $yesterday_calc - 1;

      $start2dTime = strval($currentYear.'-'.$currentMonth.'-'.$two_days_calc);
      $end2dTime = strval($currentYear.'-'.$currentMonth.'-'.$yesterday_calc);

      $twoDaysAgo = views($apartment)
            ->period(Period::create($start2dTime, $end2dTime))
            ->count();
      // dd($twoDaysAgo);


      // === CALCOLO DELLE VISITE 3 GG fa === //
      $three_days_calc = $two_days_calc - 1;

      $start3dTime = strval($currentYear.'-'.$currentMonth.'-'.$three_days_calc);
      $end3dTime = strval($currentYear.'-'.$currentMonth.'-'.$two_days_calc);

      $threeDaysAgo = views($apartment)
            ->period(Period::create($start3dTime, $end3dTime))
            ->count();
      // dd($treeDaysAgo);


      // === CALCOLO DELLE VISITE 4 GG fa === //
      $four_days_calc = $three_days_calc - 1;

      $start4dTime = strval($currentYear.'-'.$currentMonth.'-'.$four_days_calc);
      $end4dTime = strval($currentYear.'-'.$currentMonth.'-'.$three_days_calc);

      $fourDaysAgo = views($apartment)
            ->period(Period::create($start4dTime, $end4dTime))
            ->count();
      // dd($fourDaysAgo);


      // === CALCOLO DELLE VISITE 5 GG fa === //
      $five_days_calc = $four_days_calc - 1;

      $start5dTime = strval($currentYear.'-'.$currentMonth.'-'.$five_days_calc);
      $end5dTime = strval($currentYear.'-'.$currentMonth.'-'.$four_days_calc);

      $fiveDaysAgo = views($apartment)
            ->period(Period::create($start5dTime, $end5dTime))
            ->count();


      // === CALCOLO DELLE VISITE 6 GG fa === //
      $six_days_calc = $five_days_calc - 1;

      $start6dTime = strval($currentYear.'-'.$currentMonth.'-'.$six_days_calc);
      $end6dTime = strval($currentYear.'-'.$currentMonth.'-'.$five_days_calc);

      $sixDaysAgo = views($apartment)
            ->period(Period::create($start6dTime, $end6dTime))
            ->count();


      // === CALCOLO DELLE VISITE 7 GG fa === //
      $seven_days_calc = $six_days_calc - 1;

      $start7dTime = strval($currentYear.'-'.$currentMonth.'-'.$seven_days_calc);
      $end7dTime = strval($currentYear.'-'.$currentMonth.'-'.$six_days_calc);

      $sevenDaysAgo = views($apartment)
            ->period(Period::create($start7dTime, $end7dTime))
            ->count();

      // dd($sevenDaysAgo);





      // ---------------- Statistiche Annuali
      $startYear = Carbon::createFromDate($currentYear, 1, 1);
      $endYear = $currentYear . '-12-31';
      // dd($endYear);

      $thisYear = views($apartment)
            ->period(Period::create($startYear, $endYear))
            ->count();
      // dd($thisYear);


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


      // ----------------- Statistiche Settimanali
      //    --> Totali
      $thisWeek = views($apartment)
             ->period(Period::pastWeeks(1))
             ->remember()
             ->count();
            //  dd($thisWeek);


      // return view('admin.visits.show', compact('apartment', 'thisYear', 'pastTrimester', 'pastSemester', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', 'thisWeek', 'thisDay', 'yesterday', 'twoDaysAgo', 'threeDaysAgo', 'fourDaysAgo', 'fiveDaysAgo', 'sixDaysAgo',));

      return view('admin.visits.show', [
        'apartment' => $apartment,
        'january' => $january,
        'february' => $february,
        'march' => $march,
        'april' => $april,
        'may' => $may,
        'june' => $june,
        'july' => $july,
        'august' => $august,
        'september' => $september,
        'october' => $october,
        'november' => $november,
        'december' => $december,
        'thisWeek' => $thisWeek,
        'thisDay' => $thisDay,
        'yesterday' => $yesterday,
        'twoDaysAgo' => $twoDaysAgo,
        'threeDaysAgo' => $threeDaysAgo,
        'fourDaysAgo' => $fourDaysAgo,
        'fiveDaysAgo' => $fiveDaysAgo,
        'sixDaysAgo' => $sixDaysAgo,
        'sevenDaysAgo' => $sevenDaysAgo,

      ]);
  }
}
