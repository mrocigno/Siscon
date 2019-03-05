<?php

namespace App\Http\Controllers;

use App\Applicants;
use App\Polo;
use App\ServiceType;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Excel;
use Validator, Input, Redirect, Auth;
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
            $results = Excel::load($tempFile['localPath'])->get()->toArray();
            $titles = [];
            $i = 0;
            foreach ($results[0] as $key => $values){
                ++$i;
                array_push($titles,"$key");
            }
            $fileVles = [
                'name' =>  $request->file->getClientOriginalName(),
                'localPath' => $tempFile['localPath']
            ];
            $applicants = Applicants::orderBy('name','asc')->where('company_id', Auth::user()->company_id)->get();
            $serviceType = ServiceType::orderBy('type','asc')->where('company_id', Auth::user()->company_id)->get();
            $polos = Polo::orderBy('polo','asc')->where('company_id', Auth::user()->company_id)->get();
            return Redirect::to('importar/planilha')
                ->with('rows',$results)
                ->with('file', $fileVles)
                ->with('polos', $polos)
                ->with('titles', $titles)
                ->with('applicants', $applicants)
                ->with('serviceType', $serviceType);
        }
    }

    public function plan(){
        return view('import_view_plan');
    }

    public function save(Request $request){
        var_dump($request);
    }
    
}
