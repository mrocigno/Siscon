<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect, Auth;
use App\Applicants;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportController extends Controller{

    public function add(){
        return view('admin.views.report_add');
    }

    public function store(Request $request){
        $rules = array(
            'nome'    => 'required|max:30',
            'email'    => 'required',
            'telefone' => 'max:20'
        );
        
        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O :attribute deve ter até :max digitos'
        );
        
        $fields = [
            'nome' => $request->name,
            'email' => $request->email,
            'telefone' => $request->telefone
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('solicitante/add')
                ->withErrors($validator)
                ->withInput($request->input());
        }else{
            $data = [
                'name' => $request->name,
                'company_id' => Auth::user()->company_id,
                'email' => $request->email,
                'telefone' => $request->telefone
            ];
            $query = Applicants::create($data);
            return Redirect::to('solicitante/add')
                ->with('message', 'Solicitante adicionado com sucesso');
        }
    }
    
    public function edit($id){
        $query = Applicants::findOrFail($id);
        return view('admin.views.applicant_edit')->with('applicant', $query);
    }
    
    public function update(Request $request){
         $rules = array(
            'nome'     => 'required|max:30',
            'email'    => 'required',
            'telefone' => 'max:20'
        );
        
        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O :attribute deve ter até :max digitos'
        );
        
        $fields = [
            'nome' => $request->name,
            'email' => $request->email,
            'telefone' => $request->telefone
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        }else{
            $query = Applicants::findOrFail($request->id);
            $query->name = $request->name;
            $query->email = $request->email;
            $query->telefone = $request->telefone;
            $query->save();
            return Redirect::back()
                ->with('message', 'Solicitante editado com sucesso');
        }
    }

    public function lista(){
        $applicants = Applicants::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->get();
        return view('admin.views.applicant_list')->with('applicants', $applicants);
    }
    
    public function destroy($id){
        $query = Applicants::findOrFail($id);
        $query->delete();
        return Redirect::to('solicitante/lista')
                ->with('message', 'Solicitante removido com sucesso'); 
    }
}
