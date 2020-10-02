@extends('layouts.app')

@section('content')
    <div class="container py-5">
      <h1>{{$apartment->title}}</h1>
      @if (!$apartment->messages->isEmpty())
        <h2>Ecco i tuoi messaggi</h2>
        @foreach ($apartment->messages as $message)
          <div class="apartment-messages-page">
              <h3 class="message-title">{{$message->msg_title}}</h3>
              <div class="message-detail">
                  <div class="ms_user-info">
                    <div>Nome mittente: {{$message->sender_name}}</div>
                    <div>Email mittente: {{$message->sender_mail}}</div>
                  </div>
                  <div class="ms_user-message">
                    {{$message->message}}
                  </div>
              </div>
          </div>
        @endforeach
      @else
        <h2>Non hai ancora i messaggi</h2>
      @endif

    </div>
    <script src="{{asset('js/boolbnb/admin/messages/show.js')}}"></script>
@endsection
