<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Apartment;
use App\Service;
use App\Message;

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

      return view('guest.apartments.index', [
        'apartments' => $apartments,
        'services' => $services,
        'placesInfo' => $placeInfo,
      ]);

    }

    /**
     * Search.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      $data = $request->all();
      dd($data);
      // $apartments = Apartment::orderBy('created_at', 'desc')->paginate(5);
      // $services = Service::all();
      //
      // return view('guest.apartments.index', [
      //   'apartments'=>$apartments,
      //   'services'=>$services,
      // ]);

      return view('guest.apartments.search');
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

        $data = $request->all();
        $apartment_id = $data['apartment_id'];
        // dd($data);

        $new_massage = new Message();
        $new_massage->apartment_id = $apartment_id;
        $new_massage->msg_title = $data['msg_title'];
        $new_massage->sender_name = $data['sender_name'];
        $new_massage->sender_mail = $data['sender_mail'];
        $new_massage->message = $data['message'];
        $new_massage->save();

        return redirect()->route('guest.apartments.show', $apartment_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('guest.apartments.show', compact('apartment'));
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

}
