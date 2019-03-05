<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect, Auth;
use App\Delivery;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller {
    
    public function add(){
        return view('admin.views.applicant_add');
    }

    public function store(Request $request){
        
    }
    
    public function edit($id){
        $query = Delivery::findOrFail($id);
        return view('admin.views.delivery_edit')->with('delivery', $query);
    }
    
    public function update(Request $request){
         $rules = array(
            'nome'     => 'required|max:100',
        );
        
        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O :attribute deve ter até :max digitos'
        );
        
        $fields = [
            'nome' => $request->name
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator);
        }else{
            $query = Delivery::findOrFail($request->id);
            $query->name = $request->name;
            $query->save();
            return Redirect::back()
                ->with('message', 'Remessa editada com sucesso');
        }
    }

    public function lista(){
        $query = Delivery::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->get();
        return view('admin.views.delivery_list')->with('deliveries', $query);
    }
    
    public function destroy($id){
       
    }
}
