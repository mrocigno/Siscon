<?php

namespace App\Http\Controllers;

use App\Applicants;
use App\Polo;
use App\ServiceType;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Excel;
use Validator, Redirect, Input, Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class ImportController extends Controller {
    
    public function index(){
        return view('import_services');
    }
    
    public function importPlan(Request $request, ImageRepository $repository){
        $rules = [
            'file' => 'required'
        ];
        
        $messages = [
            'required' => 'Importe uma planilha'
        ];
        
        $fields = [
            'file' => $request->file
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if($validator->fails()){
            return Redirect::back();
        }else{
            $tempFile = $repository->saveTempFile($request->file);
            return Redirect::to('importar/planilha')
                ->with('localPath', $tempFile['localPath'])
                ->with('name', $request->file->getClientOriginalName());
        }
    }

    public function showPlan(){
        try{
            $localPath = session()->get('localPath');
            $results = Excel::load($localPath)->get()->toArray();
            $titles = [];
            $i = 0;
            foreach ($results[0] as $key => $values){
                ++$i;
                array_push($titles,"$key");
            }
            $fileVles = [
                'name' =>  session()->get('name'),
                'localPath' => $localPath
            ];
            $applicants = Applicants::orderBy('name','asc')->where('company_id', Auth::user()->company_id)->get();
            $serviceType = ServiceType::orderBy('type','asc')->where('company_id', Auth::user()->company_id)->get();
            $polos = Polo::orderBy('polo','asc')->where('company_id', Auth::user()->company_id)->get();
            return view('import_view_plan')
                ->with('rows',$results)
                ->with('file', $fileVles)
                ->with('polos', $polos)
                ->with('titles', $titles)
                ->with('applicants', $applicants)
                ->with('serviceType', $serviceType);
        }catch (\Exception $e){
            return Redirect::back()
                ->with('message', 'Erro ao abrir planilha');
        }
    }

    public function save(Request $request){
        echo $request->concat;
        $rules = [
            'remessa' => 'required|max:30',
            'solicitante' => 'required_without:colSol',
            'colSol' => 'required_without:solicitante',
            'data' => 'required_without:colData',
            'colData' => 'required_without:data',
            'tipo' => 'required_without:colTipo',
            'colTipo' => 'required_without:tipo',
            'polo' => 'required_without:colPolo',
            'colPolo' => 'required_without:polo',
            'endereco' => 'required_without:colEndereco',
            'colEndereco' => 'required_without:endereco'
        ];

        $messages = [
            'required' => 'Selecione um :attribute'
        ];

        $fileds = [
            'remessa' => $request->name,
            'solicitante' => $request->applicant,
            'colSol' => $request->colApplicant,
            'data' => $request->dateReceive,
            'colData' => $request->colDateReceive,
            'tipo' => $request->serviceType,
            'colTipo' => $request->colServiceType,
            'polo' => $request->polo,
            'colPolo' => $request->colPolo,
            'endereco' => $request->address,
            'colEndereco' => $request->colAddress
        ];

        $validator = Validator::make($fileds, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()
                ->with('localPath', $request->localPath)
                ->with('name', $request->name)
                ->withInput(Input::all())
                ->withErrors($validator);
        }
    }
    
}
