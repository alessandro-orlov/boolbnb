<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Apartment;

class SearchController extends Controller
{
    public function searchResults(Request $request) {

        $rooms = $request->get('rooms');
        $beds = $request->get('beds');
        $wifi = $request->get('wifi');
        $parking = $request->get('parking');
        $swimmingPool = $request->get('swimmingPool');
        $reception = $request->get('reception');
        $sauna = $request->get('sauna');
        $seaView = $request->get('seaView');

        // dichiaro le mie costanti per trasformare un raggio espresso in Km in gradi longitudinali e latitudinali
        $R = 6371; // raggio della Terra in km
        $rad = intval($request->get('radius'));
        $lat = floatval($request->get('latitude'));
        $lon = floatval($request->get('longitude'));

        // parametri che trasformano il mio raggio espresso in km in gradi longitudinali e latitudinali
        $params = [
            "maxLat" => $lat + rad2deg($rad/$R),
            "minLat" => $lat - rad2deg($rad/$R),
            "maxLon" => $lon + rad2deg(asin($rad/$R) / cos(deg2rad($lat))),
            "minLon" => $lon - rad2deg(asin($rad/$R) / cos(deg2rad($lat))),
        ];

        // Costruisco la query
        $queryApartment = Apartment::query();

        if ($wifi == 'checked') {
            $queryApartment->whereHas('services', function (Builder $query) {
                $query->where('service_id', '=', '1');
            });
        }

        if ($parking == 'checked') {
            $queryApartment->whereHas('services', function (Builder $query) {
                $query->where('service_id', '=', '2');
            });
        }

        if ($swimmingPool == 'checked') {
            $queryApartment->whereHas('services', function (Builder $query) {
                $query->where('service_id', '=', '3');
            });
        }
        //
        if ($reception == 'checked') {
            $queryApartment->whereHas('services', function (Builder $query) {
                $query->where('service_id', '=', '4');
            });
        }

        if ($sauna == 'checked') {
            $queryApartment->whereHas('services', function (Builder $query) {
                $query->where('service_id', '=', '5');
            });
        }

        if ($seaView == 'checked') {
            $queryApartment->whereHas('services', function (Builder $query) {
                $query->where('service_id', '=', '6');
            });
        }

        // $queryApartment->where('rooms', '>=' ,$rooms);
        // $queryApartment->where('beds', '>=' ,$beds);

        $queryApartment->whereBetween('latitude', [$params['minLat'], $params['maxLat']]);
        $queryApartment->whereBetween('longitude', [$params['minLon'], $params['maxLon']]);

        return $queryApartment->get();

    }
}
