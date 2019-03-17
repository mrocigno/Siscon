<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth, Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Companies;
use App\UserType;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::check()) {
            return Redirect::to('inicio');
            //echo Auth::user()->company_id;
        }else{
            return view('login');
        }
    }
    
    public function attemptLogin(){
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        
        $messages = array(
                'required' => "Preencha o campo :attribute",
                'min' => 'A senha deve ter ao menos 3 digitos'
            );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $data = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                );
            
            if(Auth::attempt($data)){
                return Redirect::to('inicio');
            }else{
                $dataErr = array('email' => 'Login/Senha incorretos');
                return Redirect::to('login')
                    ->withErrors($dataErr)
                    ->withInput(Input::all());
            }
        }
        
    }

    public function logout(){
        Auth::logout();
        return view('login');
    }

    public function add(){
        $companies = Companies::orderBy('name', 'asc')->get();
        $userType = UserType::orderBy('name', 'asc')->where('company_id', '<>' , 1)->get();
        return view('admin.views.user_add')
            ->with('companies', $companies)
            ->with('userType', $userType);
    }

    public function store(Request $request){
        $rules = array(
            'empresa' => 'required',
            'nome'    => 'required|max:255',
            'email'    => 'required|unique:users|max:255',
            'password' => 'max:60|required|confirmed',
            'tipoDeUsuário' => 'required'
        );

        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O :attribute deve ter até :max digitos',
            'unique' => 'Email já cadastrado',
            'confirmed' => 'As senha não conferem'
        );

        $fields = [
            'empresa' => $request->company,
            'nome' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'tipoDeUsuário' => $request->userType
        ];

        $validator = Validator::make($fields, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('usuarios/add')
                ->withErrors($validator)
                ->withInput($request->input());
        }else{
            $data = [
                'name' => $request->name,
                'company_id' => $request->company,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type_id' => $request->userType
            ];
            $query = User::create($data);
            return Redirect::to('usuarios/add')
                ->with('message', 'Usuário adicionado com sucesso');
        }
    }
}
