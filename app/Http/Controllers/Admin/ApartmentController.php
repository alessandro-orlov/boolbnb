<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        $new_apartment->city = $data['city'];
        $new_apartment->region = $data['region'];
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
    public function edit(Apartment $apartment)
    {
      $user = Auth::user();
      $services = Service::all();

      if ($apartment->user_id == $user->id) {
        return view('admin.apartments.edit', compact('apartment', 'services'));
      } else {
        abort(403);
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
      $request->validate($this->validationData());
      $data = $request->all();

      // dd($data);

      $apartment->title = $data['title'];
      $apartment->num_rooms = $data['num_rooms'];
      $apartment->num_beds = $data['num_beds'];
      $apartment->num_baths = $data['num_baths'];
      $apartment->mq = $data['mq'];
      $apartment->address = $data['address'];
      $apartment->latitude = $data['latitude'];
      $apartment->longitude = $data['longitude'];
      $apartment->city = $data['city'];
      $apartment->region = $data['region'];
      $apartment->description = $data['description'];
      $apartment->price = $data['price'];

      // New image upload
      if (isset($data['main_img'])) {
        // Elimino l'immagine vecchia
        Storage::delete('public/'. $apartment->main_img);

        $path = $request->file('main_img')->store('img', 'public');
        $apartment->main_img = $path;

      } else {
        $apartment->main_img = '';
      }

      // Chekboxes update
        if (isset($data['services'])) {
          $apartment->services()->sync($data['services']);
        } else {
          $apartment->services()->detach();
        }

      $apartment->update();

      $apartment->save();

      return redirect()->route('admin.apartments.show', $apartment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
      // DETACH
      $apartment->services()->detach();
      // $apartment->sponsorships()->detach();

      // Elimino la foto dallo storage
      Storage::delete('public/'. $apartment->main_img);

      // Delete Apartment
      $apartment->delete();

      $user = Auth::user();

      return redirect()->route('admin.apartments.index', compact('user'));
    }

    public function validationData() {
      return [
        'title' => 'required|max:255',
        'num_rooms' => 'required|integer',
        'num_beds' => 'required|integer',
        'num_baths' => 'required|integer',
        'mq' => 'required|integer',
        'address' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'city' => 'required',
        'region' => 'required',
        'description' => 'required',
        'price' => 'required|integer',
      ];
    }

}
