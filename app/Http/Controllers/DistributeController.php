<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Validator;
use App\Services;
use App\User;
use App\DistributedServices;
use App\Polo;
use App\Status;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DistributeController extends Controller {

    public function index(){
        $services = Services::orderBy('services.id', 'asc')
            ->join('address as adr', 'adr.id', '=', 'services.address_id')
            ->join('polos as po', 'po.id', '=', 'services.polo_id')
            ->join('service_type as st', 'st.id', '=', 'services.service_type_id')
            ->join('applicants as ap', 'ap.id', '=', 'services.applicant_id')
            ->join('delivery as dv', 'dv.id', '=', 'services.delivery_id')
            ->leftJoin('distributed_services as ds', 'services.id', '=', 'ds.service_id')
            ->where('services.company_id', Auth::user()->company_id)
            ->whereNotIn('ds.status_id', ['1', '2', '4'])
            ->orWhereNull('ds.status_id')
            ->get(['services.id as sid', 'services.*', 'adr.*', 'po.*', 'ap.*', 'dv.*', 'ds.*', 'st.*']);

        $users = User::orderBy('name', 'asc')
            ->where('user_type_id', 4)
            ->get();
//        echo $services;
        return view('distribute_services')
            ->with('services', $services)
            ->with('count', count($services))
            ->with('users', $users);
    }

    public function createRoute(Request $request){
        $rules = [
            'usuário' => 'required',
            'dia' => 'required',
            'serviço' => 'required'
        ];

        $messages = [
            'required' => "Selecione um :attribute"
        ];

        $fields = [
            'usuário' => $request->userId,
            'dia' => $request->date,
            'serviço' => $request->ids
        ];

        $validator = Validator::make($fields, $rules, $messages);
        if($validator->fails()){
            return Redirect::to('distribuir')
                ->withErrors($validator)
                ->withInput($request->input());;
        }else{
            if($request->ids != null){
                foreach ($request->ids as $id){
                    $data = [
                        'service_id' => $id,
                        'distributed_date' => $request->date,
                        'user_id' => $request->userId,
                        'status_id' => 4,
                    ];
                    DistributedServices::create($data);
                }

            }
        }

    }

}
