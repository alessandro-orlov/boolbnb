@extends('layouts.app')

@section('content')
  <div class="container py-5">
      <div class="">
          <p class="office-heading"><span class="greetings">Buongiorno</span> {{$user->name}} {{$user->lastname}}</p>
          <h1>Benvenuto nella tua area riservata</h1>
      </div>

      <div class="user-apartments">
          <div class="table-responsive-sm">
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
                            <th scope="row" class="ms_data">{{$apartment->created_at->format('d/m/y H:m')}}</th>

                            {{-- Apartment FOTO --}}
                            <td class="apartment-foto">

                              @if (!empty($apartment->main_img))
                                <div class="bool_img_apt">
                                  <a href="{{route('apartments.show', $apartment)}}">
                                    @if (strpos($apartment->main_img,'mpixel'))
                                      <img src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                                    @else
                                      <img src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
                                    @endif
                                  </a>
                                </div>
                              @endif
                            </td>
                            
                            <td class="apartment-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit</td>
                            <td>8</td>
                            <td>4</td>
                            <td>#</td>
                            <td>
                              <a href="{{route('admin.apartments.show', $apartment)}}">show</a>
                              <a href="{{route('admin.apartments.edit', $apartment)}}">modifica</a>
                            </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div> <!-- end table-responsive -->
      </div> <!-- end user-apartment -->
  </div> <!-- end container-->
@endsection
