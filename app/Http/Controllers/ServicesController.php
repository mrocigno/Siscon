<?php

namespace App\Http\Controllers;

use App\ServiceType;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use App\Services;
use Illuminate\Support\Facades\DB;
use Validator, Input, Redirect, Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicesController extends Controller{

    public function index(){
        $statuses = Status::query()->get();
        $types = ServiceType::query()->where('company_id', Auth::user()->company_id)->get();
        $externalUsers = User::query()->where('user_type_id', '4')->where('company_id', Auth::user()->company_id)->get();
        return view('services')
            ->with('statuses', $statuses)
            ->with('types', $types)
            ->with('externalUsers', $externalUsers);
    }

    public function listServicesByDelivery($id){
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

    public function getTable(){
        $data = Input::all();
        $errors['msg'] = '';

        $order = $data['order'];
        $select = [
            'services.id as sid',
            'services.identifier',
            'services.date_received',
            'st.type',
            'adr.address',
            'services.n',
            'services.lat',
            'services.lng',
            'services.service_description',
            'services.pg_guia',
            'ap.name as applicant',
            'po.polo',
            'ds.status_id',
            'dv.name as delivery',
        ];

        if($data['order'] == 'distance'){
            if( $data['lat'] == "" && $data['lng'] == ""){
                $order = 'sid';
                $errors['msg'] = "Para ordenar por Distancia informe uma latitude e uma longitude";
            }else{
                array_push($select, DB::raw('(acos(sin('.$data['lat'].') * sin(services.lat) + cos('.$data['lat'].') * cos(services.lat) * cos(services.lng - ('.$data['lng'].'))) * 6371) as distance'));
            }
        }

        $services = Services::query()
            ->select($select)
            ->orderBy($order, $data["direction"])
            ->join('address as adr', 'adr.id', '=', 'services.address_id')
            ->join('polos as po', 'po.id', '=', 'services.polo_id')
            ->join('service_type as st', 'st.id', '=', 'services.service_type_id')
            ->join('applicants as ap', 'ap.id', '=', 'services.applicant_id')
            ->join('delivery as dv', 'dv.id', '=', 'services.delivery_id')
            ->leftJoin('distributed_services as ds', 'services.id', '=', 'ds.service_id')
            ->where('services.company_id', Auth::user()->company_id);

        switch ($data['_type']){
            case 'toDistribute': {
                $view = view('services.distribute_table');
                $services
                    ->where(function($query){
                        $query->whereIn('ds.status_id', ['3']);
                        $query->orWhereNull('ds.status_id');
                    });
                break;
            }

            case 'toFinalize': {
                $view = view('services.finalize_table');
                $services
                    ->where('ds.status_id', '4');
                break;
            }

            case 'showAll': {
                $view = view('services.distribute_table');
                break;
            }
        }

        if(isset($data['type']) && $data['type'] != ""){
            $services->where('service_type_id', $data['type']);
        }

        if(isset($data['status']) && $data['status'] != ""){
            switch ($data['status']){
                case 6:{
                    $services
                        ->whereNull('ds.status_id')
                        ->where('services.lat', '<>',  '0')
                        ->where('services.lng', '<>',  '0');
                    break;
                }
                case 7:{
                    $services
                        ->whereNull('ds.status_id')
                        ->where('services.lat',  '0')
                        ->where('services.lng',  '0');
                    break;
                }
                default: {
                    $services->where('status_id', $data['status']);
                    break;
                }
            }
        }

        if($data['identifiers'] != ""){
            $identifiers = explode("\n", $data['identifiers']);
            $identifiers = array_map('trim',$identifiers);
            $services->whereIn('services.identifier', $identifiers);
        }

        $services = $services->get();

        return $view->with('services', $services)
            ->with('count', count($services))
            ->withErrors($errors);
    }

}
