@extends('layouts.app')

@section('content')
  <div class="container">
      <h1>Benvenuto {{$user->name}} {{$user->lastname}}</h1>

      <ul>
          @foreach ($user->apartments as $apartment)
              <li style="display:flex;">
                  <div style="width:200px;">
                      <img style="width:100%;" src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                  </div>
                  <div>
                      {{$apartment->title}}
                  </div>
                  <div class="controls">
                      <a href="{{route('admin.apartments.show', $apartment)}}">show</a>
                  </div>
              </li>
          @endforeach
      </ul>
  </div>
@endsection
