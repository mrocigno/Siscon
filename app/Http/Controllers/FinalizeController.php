<?php

namespace App\Http\Controllers;

use App\ServiceType;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinalizeController extends Controller{

    public function index(){
        $types = ServiceType::query()->where('company_id', Auth::user()->company_id)->get();
        $externalUsers = User::query()->where('user_type_id', '4')->where('company_id', Auth::user()->company_id)->get();
        return view('finalize_services')
            ->with('types', $types)
            ->with('externalUsers', $externalUsers);
    }
}
