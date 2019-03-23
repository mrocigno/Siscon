<?php

namespace App\Http\Controllers;

use App\Address;
use App\Services;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GeolocationController extends Controller{

    public function index()
    {
        //
    }

    public function saveFormated(Request $request){
        foreach ($request->ids as $_id){
            $service = Services::findOrFail($_id);
            $rules = [
                'lat' => 'required',
                'lng' => 'required',
            ];

            $fields = [
                'lat' => $request['lat_' . $_id],
                'lng' => $request['lng_' . $_id]
            ];

            $validator = Validator::make($fields, $rules);
            if (!$validator->fails()) {
                $address = Address::findOrFail($service->address_id);
                $address->formatted_address = $request['faddress_' . $_id];
                $address->reference_address = $request['raddress_' . $_id];
                $address->neighborhood = $request['neighborhood_' . $_id];
                $address->zip_code = $request['zipCode_' . $_id];
                $address->save();

                $service->lat = $request['lat_' . $_id];
                $service->lng = $request['lng_' . $_id];
                $service->save();
            }
        }
        return Redirect::to('/remessa/lista');
    }
}
