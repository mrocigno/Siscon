<?php

namespace App\Http\Controllers;

use App\ServiceType;
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
            ->where('company_id', Auth::user()->company_id)
            ->get();
        $statuses = Status::query()->get();
        $types = ServiceType::query()->where('company_id', Auth::user()->company_id)->get();

        return view('distribute_services')
            ->with('statuses', $statuses)
            ->with('types', $types)
            ->with('users', $users);
    }

    public function createRoute(Request $request){
        $rules = [
            'usuário' => 'required',
            'dia' => 'required',
            'serviço' => 'required'
        ];

        $messages = [
            'required' => "Selecione pelo menos 1 :attribute"
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
                    $service = Services::query()->findOrFail($id);
                    $service->status_id = 4;
                    $service->save();

                    $data = [
                        'service_id' => $id,
                        'distributed_date' => $request->date,
                        'user_id' => $request->userId,
                        'status_id' => 4
                    ];
                    DistributedServices::create($data);
                }
                $user = User::query()->findOrFail($request->userId);
                return Redirect::back()
                    ->with('message', count($request->ids) . ' serviços adicionados para ' . $user->name . ' no dia ' . $request->date);
            }
        }

    }

}
