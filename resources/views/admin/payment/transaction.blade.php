@extends('layouts.app')

@section('content')
  <div class="container py-5">
      @foreach ($apartment->sponsorships as $sponsorship)
          <h2>la promo {{ $sponsorship->name }} è stata attivata sull'appartamento {{ $apartment->title }}</h2>
      @endforeach
  </div>

@endsection
