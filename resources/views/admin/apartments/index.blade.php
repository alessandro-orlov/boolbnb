@extends('layouts.app')

@section('content')
  <div class="container py-5">
      <section id="admin-index-header">
          <div class="row">
              <div class="col-md-8">
                <p class="office-heading"><span id="greetings"></span> {{$user->name}} {{$user->lastname}}</p>
                <h1>Benvenuto nella tua area riservata</h1>
              </div>
              <div class="col-md-4 big-btn-add-apt" style="vertical-align: middle;">
                  <a href="{{route('admin.apartments.create')}}" class="btn btn-boolbnb big">aggiungi un appartamento&nbsp; <i class="fas fa-plus"></i></a>
              </div>
          </div>
      </section>

      <div class="user-apartments">
          <div class="table-responsive-sm ms_apartments-table">
              <table class="table table-striped ">
                  <thead class="thead-dark">
                      <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Visite</th>
                        <th scope="col">Messaggi</th>
                        <th scope="col">Sponsorship</th>
                        <th scope="col">Opzioni</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($apartments as $apartment)
                        @if ($userId == $apartment->user_id)
                          <tr>
                            {{-- Data --}}
                            <th scope="row" class="ms_data">
                              <div class="apartment-icons">
                                <i class="far fa-calendar-alt"></i>
                              </div>
                              {{$apartment->created_at->format('d/m/y H:i')}}
                            </th>
                            {{-- Apartment FOTO --}}
                            <td class="apartment-foto-block">
                              <div class="img-thumbnail">
                                  <div class="apartment-foto">
                                      <a href="{{route('guest.apartments.show', $apartment)}}">
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
                              <a href="{{route('guest.apartments.show', $apartment)}}">{{$apartment->title}}</a>
                            </td>
                            {{-- Visits --}}
                            <td class="icons">
                              <a href="{{route('admin.visits.show', $apartment)}}">
                                  <div class="apartment-icons">
                                    <i class="far fa-eye"></i>
                                  </div>
                                  <span><?php echo views($apartment)->count(); ?></span>
                              </a>
                            </td>
                            {{-- Mesages --}}
                            <td class="icons">
                              <a href="{{route('admin.message.show', $apartment)}}">
                                  {{-- Calcolo il numero di messaggi ricevuti --}}
                                  <?php $array_msg = []; ?>
                                  @foreach ($apartment->messages as $messages)
                                    <?php $array_msg[] = $messages->apartment_id; ?>
                                  @endforeach
                                  <div class="apartment-icons">
                                      <i class="far fa-envelope"></i>
                                  </div>
                                  <div class="apartment-msg-number">
                                      <span>{{count($array_msg)}}</span>
                                  </div>
                              </a>
                            </td>
                            {{-- Sponsorship --}}
                            <td class="apartment-sponsorship">
                              <div class="apartment-icons">
                                  <i class="far fa-money-bill-alt"></i>
                              </div>
                              @if (!$apartment->sponsorships->isEmpty())
                                @foreach ($apartment->sponsorships as $sponsorship)
                                    @php
                                      $expired = date('H:i d/m/y', strtotime($sponsorship->pivot->end_date));
                                    @endphp
                                    <div class="name">
                                        {{$sponsorship->name}}
                                    </div>
                                    <div class="expired">
                                        @php
                                          echo $expired;
                                        @endphp
                                    </div>
                                @endforeach
                              @else
                                -
                              @endif
                            </td>
                            {{-- Controls --}}
                            <td>
                              <a class="controls-btn normal" href="{{route('admin.payment.index', $apartment)}}">promuovi</a>
                              <a class="controls-btn normal" href="{{route('admin.apartments.edit', $apartment)}}">modifica</a>
                              <form class="form-delete" action="{{ route('admin.apartments.destroy', $apartment)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="controls-btn delete" type="submit" value="elimina">
                              </form>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                  </tbody>
              </table>
          </div> <!-- end table-responsive -->
      </div> <!-- end user-apartment -->
  </div> <!-- end container-->
  <script src="{{asset('js/boolbnb/admin/index.js')}}"></script>
@endsection
