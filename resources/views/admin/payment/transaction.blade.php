@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <div class="text-center py-5">
      <h1>Congratulazioni {{$user->name}}</h1>
      @foreach ($apartment->sponsorships as $sponsorship)
          <h2>
            Hai attivato la sponsorizzazione <span class="boolbnb-red">{{ $sponsorship->name}}</span> per il tuo appartamento:
          </h2>
          <h3 class="py-3 boolbnb-red">{{ $apartment->title }}</h3>
          @php
            $expired = date('H:i d/m/Y', strtotime($sponsorship->pivot->end_date));
          @endphp
          <h3>scade alle: <?php echo $expired ?></h3>
      @endforeach
          <div class="py-3">
              <a class="btn btn-boolbnb" href="{{route('admin.apartments.index')}}">vai ai tuoi appartamenti</a>
          </div>
    </div>
  </div>
@endsection
