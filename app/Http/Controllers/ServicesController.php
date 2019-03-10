<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use Validator, Input, Redirect, Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicesController extends Controller{

    public function listServices($id){
        $services = Services::orderBy('services.id', 'asc')
            ->join('service_type as st', 'st.id', '=', 'services.service_type_id')
            ->join('applicants as ap', 'ap.id', '=', 'services.applicant_id')
            ->join('polos as po', 'po.id', '=', 'services.polo_id')
            ->where('services.company_id', Auth::user()->company_id)
            ->where('delivery_id', $id)
            ->get();
        return view('services_list')
            ->with('services', $services);
    }

}
