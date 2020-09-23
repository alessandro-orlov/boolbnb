{{-- @extends('') --}}
{{-- @section('') --}}

{{-- inizio sezione ricerca --}}
<section>
  <form class="" action="" method="get">
    <label class="sr-only" for="">Ricerca un appartamento</label>
    <input type="text" name="" value="">
  </form>

</section>
{{-- fine sezione ricerca --}}

{{-- inizio sezione appartamenti --}}
<section>

  <div>
    <h3>Servizi</h3>
    <ul>
      @foreach ($services as $service)
        <input type="checkbox" name="services[]" value="{{$service->id}}">
        <span>{{$service->name}}</span>
      @endforeach
    </ul>
  </div>


  @if (!$apartments->isEmpty())
    <ul>
      @foreach ($apartments as $apartment)
        <li>
          {{$apartment->title}}
          <div>
            <a class="btn btn-primary" href="{{route('apartments.show', $apartment)}}">Visualizza</a>
          </div>
        </li>
      @endforeach
    </ul>
  @endif

</section>
{{-- fine sezione appartamenti --}}


{{-- @endsection --}}
