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

/**      Avaliar ser vai precisar deletar o ja criado se for repasse*/
//                    $query = DistributedServices::query()
//                        ->join('services as s', 's.id', '=', 'distributed_services.service_id')
//                        ->where('service_id', $id)
//                        ->where('s.status_id', 3)
//                        ->first();
//                    if($query != null && $query->count()){
//                       c
//                       c
//                    }
                    $data = [
                        'service_id' => $id,
                        'distributed_date' => $request->date,
                        'user_id' => $request->userId
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
