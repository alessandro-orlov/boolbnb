<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\Image;
use App\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::orderBy('created_at', 'desc')->paginate(25);
        $user = Auth::user();

        return view('admin.apartments.index', compact('apartments', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationData());
        $data = $request->all();
        $current_user = Auth::id();
        // dd($data);

        $new_apartment = new Apartment();
        $new_apartment->user_id = $current_user;
        $new_apartment->title = $data['title'];
        $new_apartment->num_rooms = $data['num_rooms'];
        $new_apartment->num_beds = $data['num_beds'];
        $new_apartment->num_baths = $data['num_baths'];
        $new_apartment->mq = $data['mq'];
        $new_apartment->address = $data['address'];
        $new_apartment->latitude = $data['latitude'];
        $new_apartment->longitude = $data['longitude'];
        $new_apartment->description = $data['description'];
        $new_apartment->price = $data['price'];

        // Image upload
        if (isset($data['main_img'])) {
          $path = $request->file('main_img')->store('img', 'public');
          $new_apartment->main_img = $path;
        }
        $new_apartment->save();


        if (isset($data['services'])) {
          $new_apartment->services()->sync($data['services']);
        }

        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $user = Auth::user();
        if ($apartment->user_id == $user->id) {
          return view('admin.apartments.show', compact('apartment'));
        } else {
          abort(403, 'Non puoi accedere a questa pagina');
        }

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
        'title' => 'required|max:255',
        'num_rooms' => 'required',
        'num_beds' => 'required',
        'num_baths' => 'required',
        'mq' => 'required',
        'address' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'description' => 'required',
        'price' => 'required',
      ];
    }

}
