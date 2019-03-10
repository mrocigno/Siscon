<?php

namespace App\Http\Controllers;

use Validator, Input, Redirect;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\Companies;
use App\Delivery;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller{

    public function add(){
        return view('admin.views.company_add');
    }

    public function store(Request $request, ImageRepository $img){
        $rules = array(
            'nome'    => 'required|max:30',
            'logo'    => 'required'
        );
        
        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O nome deve ter até 30 digitos'
        );
        
        $fields = [
            'nome' => $request->name,
            'logo' => $request->logo
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('empresa/add')
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $product = Companies::create($request->except('logo'));
            Delivery::create(array(
                'company_id'     => $product->id,
                'name'     => 'Adicionados manualmente',
                'removable'     => false,
                'num_services' => 0
            ));

            $product->logo = $img->saveImage($request->file('logo'), $product->id);
            $product->save();
            return Redirect::to('empresa/add')
                ->with('message', 'Empresa criada com sucesso');
        }
    }
    
    public function edit($id){
        $company = Companies::findOrFail($id);
        return view('admin.views.company_edit')->with('company', $company);
    }
    
    public function update(Request $request, ImageRepository $img){
        $rules = array(
            'nome'    => 'required|max:30'
        );
        
        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O nome deve ter até 30 digitos'
        );
        
        $fields = [
            'nome' => $request->name,
            'logo' => $request->logo
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('empresa/editar/' . $request->id)
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $company = Companies::findOrFail($request->id);
            $company->name = $request->name;
            if(!is_null($request->logo)){
                $company->logo = $img->saveImage($request->file('logo'), $request->id);
            }
            $company->save();
            return Redirect::to('empresa/editar/' . $request->id)
                ->with('message', 'Empresa editada com sucesso');
        }
    }

    public function lista(){
        $companies = Companies::orderBy('id','asc')->get();
        return view('admin.views.company_list')->with('companies', $companies);
    }
    
    public function destroy($id){
        $company = Companies::findOrFail($id);
        $company->delete();
        return Redirect::to('empresa/lista')
                ->with('message', 'Empresa removida com sucesso'); 
    }
}
