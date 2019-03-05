<?php

namespace App\Http\Controllers;

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
            Excel::load($tempFile['localPath'], function($reader) {
                $results = $reader->get();
                var_dump($results);
            });
        }
        
    }
    
}
