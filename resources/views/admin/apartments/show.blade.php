@extends('layouts.app')

@section('content')
  <div class="container">
    {{-- Intestazione --}}
    <h1>{{$apartment->title}}</h1>
    {{-- Indirizzo --}}
    <div style="display:flex; justify-content:space-between;;">
        <p>
            {{$apartment->address}}
        </p>
        <p>
            <b>{{$apartment->price}}€ /a notte</b>
        </p>
    </div>
    {{-- Immagine --}}
    <div style="width: 600px;">
        <img src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
    </div>
    {{-- Servizi --}}
    <div>
      <h3>Servizi</h3>
      {{-- Controllo !array->isEmpty() --}}
      @if (!$apartment->services->isEmpty())
        @foreach ($apartment->services as $service)

          <span>{{$service->name}}</span>
          <span>{!!$service->icon!!}</span>
          <i class="fas fa-wifi"></i>

        @endforeach
      @endif
    </div>
    {{-- Caratteristiche vari --}}
    <div class="apartment-specs" >
      <div class="row">
        <div class="left col-2">
          <h4>Specifiche</h4>
          <ul style="list-style:none;">
            <li>Stanze: {{$apartment->num_rooms}} </li>
            <li>Letti: {{$apartment->num_beds}} </li>
            <li>Bagni: {{$apartment->num_baths}} </li>
            <li>Mq: {{$apartment->mq}} </li>
            <li>numero stanze: {{$apartment->num_rooms}} </li>
          </ul>
        </div>
        <div class="right col-8">
          <h4>Descrizione</h4>
          <p>
            {{$apartment->description}}
          </p>
        </div>
      </div>



    </div>
  </div>

@endsection
