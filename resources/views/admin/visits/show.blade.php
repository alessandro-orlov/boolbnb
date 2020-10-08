@extends('layouts.app')

@section('content')
  <div class="container py-5">
      <h1>{{$apartment->title}}</h1>
      <div class="statistics">
        <div style="display: none;">

          {{-- Visite totali --}}
          <div id="total-visits"> <?php echo views($apartment)->count(); ?> </div>

          {{-- Visite ultimo trimestre --}}
          <div id="trimester-visits">{{$pastTrimester}}</div>

          {{-- Visite ultimo semestre --}}
          <div id="semester-visits">{{$pastSemester}}</div>

          {{-- Visite mensili --}}
          <span id="january">{{$january}}</span>
          <span id="february">{{$february}}</span>
          <span id="march">{{$march}}</span>
          <span id="april">{{$april}}</span>
          <span id="may">{{$may}}</span>
          <span id="june">{{$june}}</span>
          <span id="july">{{$july}}</span>
          <span id="august">{{$august}}</span>
          <span id="september">{{$september}}</span>
          <span id="october">{{$october}}</span>
          <span id="november">{{$november}}</span>
          <span id="december">{{$december}}</span>

          {{-- Visite giornaliere --}}
          <div id="daily-visits">{{$thisDay}}</div>

          {{-- Visite settimanali --}}
          <div id="weekly-visits">{{$thisWeek}}</div>

        </div>
      </div>



      {{-- Grafici Charts.js --}}
      <h2>Statistiche</h2>

      {{-- Visite Totali --}}
      <div class="stats" >
        <h3>Visite Totali</h3>
        <canvas id="myChartTotal" width="500" height="100"></canvas>
      </div>


      {{-- Visite Utlimi 3 Mesi --}}
      <div class="stats">
        <h3>Visite negli ultimi 3 mesi</h3>
        <canvas id="myChartTrimester" width="500" height="100"></canvas>
      </div>


      {{-- Visite Utlimi 6 Mesi --}}
      <div class="stats" >
        <h3>Visitenegli ultimi 6 mesi</h3>
        <canvas id="myChartSemester" width="500" height="100"></canvas>
      </div>


      {{-- Visite Mensili --}}
      <div class="stats">
        <h3>Visite Mensili</h3>
        <canvas id="myChartMonths" width="500" height="100"></canvas>  
      </div>


      {{-- Visite Giornaliere --}}
      <div class="stats">
        <h3>Visite Giornaliere</h3>
        <canvas id="myChartDaily" width="500" height="100"></canvas>  
      </div>


      {{-- Visite Settimanali --}}
      <div class="stats">
        <h3>Visite Settimanali</h3>
        <canvas id="myChartWeekly" width="500" height="100"></canvas>  
      </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="{{asset('js/boolbnb/admin/visits/show.js')}}"></script>
@endsection
