<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Service;
use App\Message;
use App\User;
use Carbon\Carbon;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $placeInfo = $request->all();

      $apartments = Apartment::orderBy('created_at', 'desc')->paginate(5);
      $services = Service::all();
      $now = Carbon::now('Europe/Rome');

      // $sponsored_apartments = [];

      // foreach ($apartments as $apartment) {
      //   if (count($apartment->sponsorships) != 0) {
      //       foreach ($apartment->sponsorships as $sponsorship) {
      //           $end_date = $sponsorship->pivot->end_date;
      //           if ($end_date > $now) {
      //               $sponsored_apartments[] = $apartment;
      //           } elseif ($end_date < $now) {
      //               $apartment->sponsorships()->detach($sponsorship);
      //           }
      //       }
      //   }
      // }
      //
      // shuffle($sponsored_apartments);
      // $queryApartment = Apartment::query();
      $queryApartment = Apartment::query();
      $sponsoredApartments = $queryApartment->has('sponsorships')->with('sponsorships')->get();


      return view('guest.apartments.index', [
        'apartments' => $apartments,
        'services' => $services,
        'placesInfo' => $placeInfo,
        'sponsored_apartments' => $sponsoredApartments,
      ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Apartment $apartment)
    {
        $request->validate($this->validationData());
        $data = $request->all();

        $apartment_id = $data['apartment_id'];

        $new_massage = new Message();
        $new_massage->apartment_id = $apartment_id;
        $new_massage->msg_title = $data['msg_title'];
        $new_massage->sender_name = $data['sender_name'];
        $new_massage->sender_mail = $data['sender_mail'];
        $new_massage->message = $data['message'];

        $saved = $new_massage->save();

        if($saved) {
          return redirect()->back()->withSuccess('Messaggio è stato inviato!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {

        $user = Auth::user(); // Get the currently authenticated user
        $userId = Auth::id(); // Get the currently authenticated user's ID

        // Install: cyrildewit/eloquent-viewable PACKAGE first
        if ($userId != $apartment->user_id) {
          views($apartment)->record(); // Register the views
        }

        return view('guest.apartments.show', compact('apartment', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validationData() {
      return [
        'msg_title' => 'required|max:255',
        'sender_name' => 'required|max:255',
        'sender_mail' => 'required|max:255',
        'message' => 'required',
      ];
    }

}
