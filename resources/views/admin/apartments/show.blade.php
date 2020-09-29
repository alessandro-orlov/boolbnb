@extends('layouts.app')

@section('content')
    <div class="container py-5">
      <h1>{{$apartment->title}}</h1>
      @foreach ($apartment->messages as $message)
        <ul>
          <li>Nome mittente: {{$message->sender_name}}</li>
          <li>Email mittente: {{$message->sender_name}}</li>
          <li>{{$message->message}}</li>
        </ul>
      @endforeach
    </div>
@endsection
