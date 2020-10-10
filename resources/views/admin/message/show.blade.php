@extends('layouts.app')

@section('content')
    <div class="container py-5">
      <h1>{{$apartment->title}}</h1>

      @if (!$apartment->messages->isEmpty())
        <h2>I tuoi messaggi:</h2>
        @foreach ($apartment->messages->reverse() as $message)
          <div class="apartment-messages-container">
            <div class="apartment-message-box">
              <span class="message-created-time">{{$message->created_at->format("H:i d/m/Y")}}</span>

              <h3 class="message-title">
                <span class="open visible">
                  <i class="fas fa-envelope"></i>
                </span>
                <span class="close">
                  <i class="far fa-envelope-open"></i>
                </span>
                <span class="apartment-message-title">{{$message->msg_title}}</span>
              </h3>

              <div class="message-detail">
                  <div class="ms_user-info">
                    <h4>Info mittente</h4>
                    <div>Nome: {{$message->sender_name}}</div>
                    <div>Email: {{$message->sender_mail}}</div>
                  </div>
                  <div class="ms_user-message">
                    <h4>Messaggio</h4>
                    {{$message->message}}
                  </div>
              </div>

            </div>
            <div class="delete-this-msg">
              <form class="form-delete" action="{{ route('admin.message.destroy', $message)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"><i class="fas fa-times"></i></button>
              </form>
            </div>
          </div>
        @endforeach
      @else
        <div class="py-5">
            <h2>Non hai ricevuto ancora i messaggi <i class="far fa-sad-tear"></i></h2>
        </div>
      @endif

    </div>
    <script src="{{asset('js/boolbnb/admin/messages/show.js')}}"></script>
@endsection
