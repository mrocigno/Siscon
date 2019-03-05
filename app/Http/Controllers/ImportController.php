<?php

namespace App\Http\Controllers;

use App\Import\PlanImport;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use SimpleXLSX;
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
            $array = Excel::toArray(new PlanImport(), $tempFile['localPath']);
        }
        
    }
    
}
