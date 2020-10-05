@extends('layouts.app')

@section('content')
  <div class="container py-5">
      <h1>Le visite di questo appartamento</h1>
      <h3>{{$apartment->title}}</h3>
      <div class="stats" style="display: none;">

        <span id="total-visits"> <?php echo views($apartment)->count(); ?> </span>

        {{-- From backend --}}
        <span class="gennaio2020">{{$gennaio2020}}</span>

      </div>

      <canvas id="myChart" width="400" height="100"></canvas>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="{{asset('js/boolbnb/admin/visits/show.js')}}"></script>
@endsection
