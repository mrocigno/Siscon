<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DistributeController extends Controller {

    public function index(){
        return view('distribute_services');   
    }
}
