<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth, Hash, Config, Cookie;
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
                $time = 1440; //Config::get('session.lifetime');
                $company = Companies::query()->findOrFail(Auth::user()->company_id);
                Cookie::queue("logo", $company->logo, $time);
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
            'confirmed' => 'As senha não conferem',
            'password.required' => 'Preencha o campo senha'
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
            User::create($data);
            return Redirect::to('usuarios/add')
                ->with('message', 'Usuário adicionado com sucesso');
        }
    }

    public function lista(){
        $query = User::orderBy('users.id','asc')
            ->join('companies as cp', 'cp.id', '=', 'users.company_id')
            ->join('user_type as ut', 'ut.id', '=', 'users.user_type_id');
        if(Auth::user()->user_type_id > 1){
            $query->where('users.company_id', Auth::user()->company_id);
        }
        $query = $query->get([
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'cp.name as company_name',
            'ut.name as user_type'
        ]);

        return view('admin.views.user_list')->with('users', $query);
    }

    public function edit($id){
        $query = User::findOrFail($id);
        $companies = Companies::orderBy('name', 'asc')->get();
        $userType = UserType::orderBy('name', 'asc')->where('company_id', '<>' , 1)->get();
        return view('admin.views.user_edit')
            ->with('user', $query)
            ->with('companies', $companies)
            ->with('userType', $userType);
    }

    public function update(Request $request){
        $rules = array(
            'empresa' => 'required',
            'nome'    => 'required|max:255',
            'email'    => 'required|max:255',
            'senhaAtual' => 'required_with:password|required_with:password_confirmation',
            'password' => 'max:60|confirmed|required_with:senhaAtual|required_with:password_confirmation',
            'tipoDeUsuário' => 'required'
        );

        $messages = array(
            'required' => "Preencha o campo :attribute",
            'max'      => 'O :attribute deve ter até :max digitos',
            'unique' => 'Email já cadastrado',
            'confirmed' => 'As senha não conferem',
            'senhaAtual.required_with' => 'Quando preecher nova senha insira também a senha atual',
            'password.required_with' => 'Quando preecher senha atual insira também a nova senha'
        );

        $fields = [
            'empresa' => $request->company,
            'nome' => $request->name,
            'email' => $request->email,
            'senhaAtual' => $request->now_password,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'tipoDeUsuário' => $request->userType
        ];

        $validator = Validator::make($fields, $rules, $messages);
        if($validator->fails()){
            return Redirect::to('usuarios/editar/' . $request->id)
                ->withErrors($validator)
                ->withInput($request->input());
        }else{
            $query = User::findOrFail($request->id);
            if($query->email != $request->email){
                $validator = Validator::make($fields, ['email' => 'unique:users'], $messages);
                if($validator->fails()){
                    return Redirect::to('usuarios/editar/' . $request->id)
                        ->withErrors($validator)
                        ->withInput($request->input());
                }
            }
            if($request->now_password != "" && !Hash::check($request->now_password, $query->password)){
                return Redirect::to('usuarios/editar/' . $request->id)
                    ->withErrors(['password' => 'Senha atual incorreta'])
                    ->withInput($request->input());
            }
            $query->company_id = $request->company;
            $query->name = $request->name;
            $query->email = $request->email;
            $query->user_type_id = $request->userType;
            $query->password = Hash::make($request->password);
            $query->save();
            return Redirect::back()
                ->with('message', 'Usuário editado com sucesso');
        }
    }

    public function destroy($id){
        $query = User::findOrFail($id);
        $query->delete();
        return Redirect::to('usuarios/lista')
            ->with('message', 'Usuário removido com sucesso');
    }

}
