<?php

namespace App\Http\Controllers;

use App\DistributedServices;
use App\FinalizedServices;
use App\Photos;
use App\Repositories\ImageRepository;
use App\Services;
use App\ServiceType;
use App\User;
use App\Utils\ResponseJsonUtil;
use Illuminate\Http\Request;
use Auth, Validator, Response, Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinalizeController extends Controller{

    public function index(){
        $types = ServiceType::query()->where('company_id', Auth::user()->company_id)->get();
        $externalUsers = User::query()->where('user_type_id', '4')->where('company_id', Auth::user()->company_id)->get();
        return view('finalize_services')
            ->with('types', $types)
            ->with('externalUsers', $externalUsers);
    }


    public function endService(Request $request, ImageRepository $img){
        $image = $request->img;
        $distId = $request->id;
        $status = $request->status;
        $observation = $request->observation;

        $fields = [
            'image' => $image,
            'distId' => $distId,
            'status' => $status,
            'observation' => $observation
        ];

        $rules = [
            'image' => 'required_if:status,==,1',
            'observation' => 'required_if:status,==,2',
            'distId' => 'required',
            'status' => 'required'
        ];

        $validator = Validator::make($fields, $rules);
        if(!$validator->fails()){
            $ds = DistributedServices::findOrFail($distId);
            $ds->status_id = $status;
            $ds->save();

            $service = Services::query()->findOrFail($ds->service_id);
            $service->status_id = $status;
            $service->save();

            if($status == 1){
                $fs = FinalizedServices::query()->where('distributed_service_id', $distId)->firstOrCreate([
                    'distributed_service_id' => $distId
                ]);
                $imgLink = $img->saveB64("img/services/" . $fs->id . "/" , $image);

                Photos::create([
                    'finalized_service_id' => $fs->id,
                    'link' => $imgLink
                ]);
            } elseif ($status == 2){
                FinalizedServices::create([
                    'distributed_service_id' => $distId,
                    'observation' => $observation
                ]);
            }
            return Response::json(ResponseJsonUtil::response(200, 'Serviço finalizado com sucesso', null), 200);
        } else {
            return Response::json(ResponseJsonUtil::response(401, 'Erro', $validator->errors()), 401);
        }
    }

    public function finalizeByPlan(Request $request){
        $rules = [
            'file' => 'required'
        ];

        $messages = [
            'required' => 'Importe uma planilha'
        ];

        $fields = [
            'file' => $request->plan
        ];

        $validator = Validator::make($fields, $rules, $messages);
        if($validator->fails()){
            return ResponseJsonUtil::response(401, "sem mesa", null);
        }else{
            $results = Excel::load($request->plan)->get()->toArray();
            if($results){
                $obrigatory = [
                    'id_de_distribuicao',
                    'observacao',
                    'foto1',
                    'foto2',
                    'foto3',
                    'foto4',
                    'foto5'
                ];
                foreach ($obrigatory as $value){
                    if(!isset($results[0][$value])){
                        return ResponseJsonUtil::response(401, "Campo $value não encontrado", $results);
                    }
                }

                $response = [];
                foreach ($results as $row){
                    $status = $this->getStatus($row);
                    $ds = DistributedServices::query()
                        ->where('status_id', 4)
                        ->where('id', $row['id_de_distribuicao'])
                        ->first();
                    if($ds){
                        $ds->status_id = $status;
                        $ds->save();

                        $service = Services::query()->findOrFail($ds->service_id);
                        $service->status_id = $status;
                        $service->save();


                        $fs = FinalizedServices::query()->where('distributed_service_id', $row['id_de_distribuicao'])->firstOrCreate([
                            'distributed_service_id' => $row['id_de_distribuicao']
                        ]);

                        $photos = [];
                        for ($i = 1 ; $i <= 5; $i++){
                            if($row["foto$i"] && $row["foto$i"] != ''){
                                Photos::create([
                                    'finalized_service_id' => $fs->id,
                                    'link' => $row["foto$i"]
                                ]);
                                array_push($photos, $row["foto$i"]);
                            }
                        }
                        array_push($response, [
                            'id' => $row['id_de_distribuicao'],
                            'status' => $status,
                            'photos' => $photos
                        ]);
                    }
                }

            }
            return ResponseJsonUtil::response(200, "Sucesso", $response);
        }
    }

    private function getStatus($result){
        $score = 0;
        for ($i = 1 ; $i <= 5; $i++) {
            if ($result["foto$i"] && $result["foto$i"] != '') {
                $score++;
            }
        }
        if($score > 0){
            return 1;
        } else {
            return 3;
        }
    }

}
