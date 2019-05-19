<?php

namespace App\Http\Controllers;

use App\Address;
use App\Repositories\ImageRepository;

use App\Services;
use App\Utils\ResponseJsonUtil;
use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class WSController extends Controller{

    public function saveAddress(Request $request){

        $fields = [
            'sid' => $request->sid,
            'lat' => $request->lat,
            'lng' => $request->lng
        ];

        $rules = [
            'sid' => 'required',
            'lat' => 'required|not_in:0',
            'lng' => 'required|not_in:0'
        ];

        $validador = Validator::make($fields, $rules);
        if(!$validador->fails()){
            $service = Services::query()->findOrFail($request->sid);
            $service->lat = $request->lat;
            $service->lng = $request->lng;
            if($service->status_id == 6){
                $service->status_id = 5;
            }
            $service->save();

            if($request->neighborhood != null && $request->neighborhood != ""){
                $address = Address::query()->findOrFail($service->address_id);
                $address->neighborhood = $request->neighborhood;
                $address->save();
            }

            $message = "Salvo com sucesso";
            $code = 200;
            $data = "daaaaa";
        } else {
            $message = "Falta parametros";
            $code = 200;
            $data = $validador->errors();
        }

        return response(ResponseJsonUtil::response($code, $message, $data), $code)
            ->header('Content-Type', 'application/json');

    }
}
