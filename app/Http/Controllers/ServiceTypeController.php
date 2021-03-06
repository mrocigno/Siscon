<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect, Auth;
use App\ServiceType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceTypeController extends Controller{

    public function add(){
        return view('admin.views.servicetype_add');
    }
    
    public function store(Request $request){
         $rules = array(
            'nome'    => 'required|max:30',
        );
        
        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O nome deve ter até 30 digitos'
        );
        
        $fields = [
            'nome' => $request->name
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('tipo-de-servico/add')
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $data = [
                'type' => $request->name,
                'company_id' => Auth::user()->company_id  
            ];
            ServiceType::create($data);
            return Redirect::to('tipo-de-servico/add')
                ->with('message', 'Tipo adicionado com sucesso');
        }
    }
    
    public function lista(){
        $query = ServiceType::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->get();
        return view('admin.views.servicetype_list')->with('types', $query);
    }
    
    public function edit($id){
        $query = ServiceType::findOrFail($id);
        return view('admin.views.servicetype_edit')->with('type', $query);
    }
    
    public function update(Request $request){
        $rules = array(
            'nome'    => 'required|max:30'
        );
        
        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O nome deve ter até 30 digitos'
        );
        
        $fields = [
            'nome' => $request->name
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('tipo-de-servico/editar/' . $request->id)
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $query = ServiceType::findOrFail($request->id);
            $query->type = $request->name;
            $query->save();
            return Redirect::to('tipo-de-servico/editar/' . $request->id)
                ->with('message', 'Tipo de serviço editado com sucesso');
        }
    }

    public function destroy($id){
        $query = ServiceType::findOrFail($id);
        $query->delete();
        return Redirect::to('tipo-de-servico/lista')
                ->with('message', 'Tipo removido com sucesso'); 
    }
}
