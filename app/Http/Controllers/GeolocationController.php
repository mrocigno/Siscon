<?php

namespace App\Http\Controllers;

use App\Address;
use App\Services;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class GeolocationController extends Controller{

    public function index(){
        $addresses = Services::orderBy('services.id', 'asc')
            ->join('address as adr', 'adr.id', '=', 'services.address_id')
            ->where('services.company_id', Auth::user()->company_id)
            ->where('services.lat', "=", 0)
            ->orWhere('services.lng', "=", 0)
            ->get([
                'services.id as sid',
                'services.n as n',
                'adr.address as address',
                'services.lat as lat',
                'services.lng as lng',
                'adr.formatted_address as formatted_address',
                'adr.reference_address as reference_address',
                'adr.neighborhood as neighborhood',
                'adr.city as city',
                'adr.uf as uf',
                'adr.zip_code as zip_code',
            ]);
        return view('format_address')
            ->with('addresses', $addresses);
    }

    public function saveFormated(Request $request){
        foreach ($request->ids as $_id){
            $data = explode("1%C", $request['values_'. $_id]);
            $service = Services::findOrFail($_id);
            $rules = [
                'lat' => 'required',
                'lng' => 'required',
            ];

            $fields = [
                'lat' => $data[1],
                'lng' => $data[2]
            ];

            $validator = Validator::make($fields, $rules);
            if (!$validator->fails()) {
                $address = Address::findOrFail($service->address_id);
                $address->formatted_address = $data[3];
                $address->reference_address = $data[4];
                $address->neighborhood = $data[5];
                $address->zip_code = $data[8];
                $address->save();

                $service->lat = $data[1];
                $service->lng = $data[2];
                $service->save();
            }
        }
        return Redirect::to(URL::to('/servicos'));
    }
}
