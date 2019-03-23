<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Validator, DB, Input;
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
        $users = User::orderBy('name', 'asc')
            ->where('user_type_id', 4)
            ->get();

        return view('distribute_services')
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
