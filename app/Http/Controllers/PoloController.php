<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Input, Redirect, Auth;
use App\Polo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PoloController extends Controller{
    public function add(){
        return view('admin.views.polo_add');
    }

    public function store(Request $request){
        $rules = array(
            'nome'    => 'required|max:30',
        );

        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O nome deve ter até :max digitos'
        );

        $fields = [
            'nome' => $request->name
        ];

        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('polo/add')
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $data = [
                'polo' => $request->name,
                'company_id' => Auth::user()->company_id
            ];
            Polo::create($data);
            return Redirect::to('polo/add')
                ->with('message', 'Polo adicionado com sucesso');
        }
    }

    public function lista(){
        $query = Polo::orderBy('id','asc')->where('company_id', Auth::user()->company_id)->get();
        return view('admin.views.polo_list')->with('polos', $query);
    }

    public function edit($id){
        $query = Polo::findOrFail($id);
        return view('admin.views.polo_edit')->with('polo', $query);
    }

    public function update(Request $request){
        $rules = array(
            'nome'    => 'required|max:30'
        );

        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O nome deve ter até :max digitos'
        );

        $fields = [
            'nome' => $request->name
        ];

        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('polo/editar/' . $request->id)
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $query = Polo::findOrFail($request->id);
            $query->polo = $request->name;
            $query->save();
            return Redirect::to('polo/editar/' . $request->id)
                ->with('message', 'Polo editado com sucesso');
        }
    }

    public function destroy($id){
        $query = Polo::findOrFail($id);
        $query->delete();
        return Redirect::to('polo/lista')
            ->with('message', 'Polo removido com sucesso');
    }
}
