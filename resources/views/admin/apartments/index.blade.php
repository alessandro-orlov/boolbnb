@extends('layouts.app')

@section('content')
  <div class="container py-5">
      <div class="">
          <p class="office-heading"><span id="greetings"></span> {{$user->name}} {{$user->lastname}}</p>
          <h1>Benvenuto nella tua area riservata</h1>
      </div>

      <div class="user-apartments">
          <div class="table-responsive-sm ms_apartments-table">
              <table class="table table-striped ">
                  <thead class="thead-dark">
                      <tr>
                        <th scope="col">data</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Visite</th>
                        <th scope="col">Messaggi</th>
                        <th scope="col">Sponsorship</th>
                        <th scope="col">Opzioni</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($user->apartments as $apartment)
                          <tr>
                            {{-- Data --}}
                            <th scope="row" class="ms_data">
                              <div class="apartment-icons">
                                <i class="far fa-calendar-alt"></i>
                              </div>
                              {{$apartment->created_at->format('d/m/y H:m')}}
                            </th>
                            {{-- Apartment FOTO --}}
                            <td class="apartment-foto-block">
                              <div class="img-thumbnail">
                                  <div class="apartment-foto">
                                      <a href="{{route('admin.apartments.show', $apartment)}}">
                                      @if (!empty($apartment->main_img))
                                          @if (strpos($apartment->main_img,'mpixel'))
                                              <img src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                                            @else
                                              <img src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
                                          @endif
                                      @else
                                          <img src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                                      @endif
                                      </a>
                                  </div>
                              </div>
                            </td>
                            {{-- Title --}}
                            <td class="apartment-title">
                              <a href="{{route('admin.apartments.show', $apartment)}}">{{$apartment->title}}</a>
                            </td>
                            {{-- Visits --}}
                            <td>
                              <div class="apartment-icons">
                                <i class="far fa-eye"></i>
                              </div>
                              81
                            </td>
                            {{-- Mesages --}}
                            <td>
                              <div class="apartment-icons">
                                <i class="far fa-envelope"></i>
                              </div>
                              4
                            </td>
                            {{-- Sponsorship --}}
                            <td>
                              <div class="apartment-icons">
                                <i class="far fa-money-bill-alt"></i>
                              </div>
                              €€€
                            </td>
                            {{-- Controls --}}
                            <td>
                              <a class="controls-btn normal" href="#">promuovi</a>
                              <a class="controls-btn normal" href="{{route('admin.apartments.edit', $apartment)}}">modifica</a>
                                <form class="form-delete" action="{{ route('admin.apartments.destroy', $apartment)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <input class="controls-btn delete" type="submit" value="elimina">
                                </form>


                            </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div> <!-- end table-responsive -->
      </div> <!-- end user-apartment -->
  </div> <!-- end container-->
  <script src="{{asset('js/boolbnb/admin/index.js')}}"></script>
@endsection
