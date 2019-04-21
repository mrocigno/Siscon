<?php

namespace App\Http\Controllers;

use App\Address;
use App\Applicants;
use App\Delivery;
use App\DistributedServices;
use App\FinalizedServices;
use App\ModelsVO\PrintVO;
use App\Photos;
use App\Polo;
use App\ServiceType;
use App\Status;
use App\User;
use App\Utils\StatusUltil;
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

    public function details($id){
        $service =      Services::query()->where('company_id', Auth::user()->company_id)->where('id', $id)->firstOrFail();
        $address =      Address::query()->findOrFail($service->address_id);
        $types =        ServiceType::query()->where('company_id', Auth::user()->company_id)->get();
        $applicants =   Applicants::query()->where('company_id', Auth::user()->company_id)->get();
        $polos =        Polo::query()->where('company_id', Auth::user()->company_id)->get();
        $status =       StatusUltil::getStatus($service->status_id);
        $users =        User::query()->where('company_id', Auth::user()->company_id)->where('user_type_id', 4)->get();
        $delivery =     Delivery::query()->findOrFail($service->delivery_id);

        $fs = null;
        $photos = null;
        $ds = DistributedServices::query()
            ->where('service_id', $service->id)
            ->where('status_id' , '<>', 3)
            ->first();
        if($ds){
            $fs = FinalizedServices::query()->where('distributed_service_id', $ds->id)->first();
            if($fs){
                $photos = Photos::query()->where('finalized_service_id', $fs->id)->get();
            }
        }
        return view('service_details')
            ->with('applicants', $applicants)
            ->with('polos', $polos)
            ->with('address', $address)
            ->with('types', $types)
            ->with('status', $status)
            ->with('ds', $ds)
            ->with('fs', $fs)
            ->with('photos', $photos)
            ->with('delivery', $delivery)
            ->with('users', $users)
            ->with('service', $service);
    }

    public function update(Request $request){

        $serviceFields = [
            'identifier' => $request->identifier,
            'date_received' => $request->date_received,
            'service_type_id' => $request->service_type_id,
            'n' => $request->n,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'service_description' => $request->service_description,
            'applicant_id' => $request->applicant_id,
            'polo_id' => $request->polo_id
        ];

        $addressFields = [
            'address' => $request->address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'uf' => $request->uf,
        ];

        $distributeFields = [
            'status_id' => $request->status_id,
            'user_id' => $request->user_id,
            'distributed_date' => $request->distributed_date
        ];

        $rules = [
            'date_received' => 'required',
            'service_type_id' => 'required',
            'n' => 'required',
            'applicant_id' => 'required',
            'polo_id' => 'required',
            'address' => 'required',
            'city' => 'required',
            'uf' => 'required',
            'distributed_date' => 'required_if:status_id,==,4',
            'user_id' => 'required_if:status_id,==,4'
        ];

        $validator = Validator::make(array_merge($serviceFields, $addressFields, $distributeFields), $rules);
        if(!$validator->fails()){
            if($request->addressEdt){
                $adress = Address::query()->with('address', $request->address)->firstOrCreate($addressFields);
                $serviceFields['address_id'] = $adress->id;
            }
            $service = Services::query()->findOrFail($request->id);
            $service->update($serviceFields);
            if($request->status_id == 4){
                $ds = DistributedServices::query()->findOrFail($request->dist_id);
                $ds->update($distributeFields);
            }
            return redirect()->back()
                ->with('message', 'Serviço editado com sucesso')
                ->withInput(Input::all());
        } else {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->with('editing', true)
                ->withInput(Input::all());
        }

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
            'services.status_id',
            'dv.name as delivery',
        ];

        if($data['order'] == 'distance'){
            if( $data['lat'] == "" && $data['lng'] == ""){
                $order = 'sid';
                $errors['msg'] = "Para ordenar por Distancia informe uma latitude e uma longitude";
            }else{
                array_push($select, DB::raw('(6371 * acos(Cos(Radians('.$data['lat'].')) * Cos(Radians(services.lat)) * Cos(Radians('.$data['lng'].') - Radians(services.lng)) + Sin(Radians('.$data['lat'].')) * Sin(Radians(services.lat)))) as distance'));
            }
        }

        $services = Services::query()
            ->orderBy($order, $data["direction"])
            ->groupBy('services.id')
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
                    ->whereIn('services.status_id', [3, 5, 6]);
                break;
            }

            case 'toFinalize': {
                array_push($select, 'ds.id as did');
                $view = view('services.finalize_table');
                $services->where('services.status_id', '4');
                $services->where('ds.status_id', '4');
                break;
            }

            case 'showAll': {
                $view = view('services.distribute_table');
                break;
            }
        }

        if( $data['lat'] != "" && $data['lng'] != "" && $data['limit'] != ""){
            $services->where(DB::raw('(6371 * acos(Cos(Radians('.$data['lat'].')) * Cos(Radians(services.lat)) * Cos(Radians('.$data['lng'].') - Radians(services.lng)) + Sin(Radians('.$data['lat'].')) * Sin(Radians(services.lat))))'), '<=', $data['limit']);
        }

        if(isset($data['type']) && $data['type'] != ""){
            $services->where('service_type_id', $data['type']);
        }

        if(isset($data['status']) && $data['status'] != ""){
            $services->where('status_id', $data['status']);
        }

        if(isset($data['user']) && $data['user'] != ""){
            $services->where('ds.user_id', $data['user']);
        }

        if(isset($data['executed_date']) && $data['executed_date'] != ""){
            $services->where('ds.distributed_date', $data['executed_date']);
        }

        if($data['identifiers'] != ""){
            $identifiers = explode("\n", $data['identifiers']);
            $identifiers = array_map('trim',$identifiers);
            $services->whereIn('services.identifier', $identifiers);
        }

        $services = $services->get($select);

        return $view->with('services', $services)
            ->with('count', count($services))
            ->withErrors($errors);
    }

    private function getPrintQuery(){
        return Services::query()
            ->groupBy('services.id')
            ->select([
                'services.id as sid',
                'services.status_id',
                'services.identifier',
                'services.service_description as description',
                'services.n',
                'adr.address',
                'type.type',
                'ds.id as did',
                'fs.id as fid',
                'fs.more_fields_json as json',
                'fs.observation as observation'
            ])
            ->join('address as adr', 'adr.id', '=', 'services.address_id')
            ->join('service_type as type', 'type.id', '=', 'services.service_type_id')
            ->leftJoin('distributed_services as ds', 'ds.service_id', '=', 'services.id')
            ->leftJoin('finalized_services as fs', 'fs.distributed_service_id', '=', 'ds.id')
            ->whereIn('ds.status_id', [1, 2]);
    }

    public function printOne($id){
        $print = [];
        $service = $this->getPrintQuery()
            ->where('services.id', $id)
            ->first();
        if($service){
            $status = StatusUltil::getStatus($service->status_id);
            $photos = Photos::query()->where('finalized_service_id', $service->fid)->get();
            $print = [
                new PrintVO($service, $status, $photos)
            ];
        }

        return view('service_report')
            ->with('prints', $print);
    }

    public function printMany(Request $resquest){
        $services = $this->getPrintQuery()
            ->whereIn('services.id', $resquest->ids)
            ->get();
        $print = [];
        foreach ($services as $service){
            $status = StatusUltil::getStatus($service->status_id);
            $photos = Photos::query()->where('finalized_service_id', $service->fid)->get();
            array_push($print, new PrintVO($service, $status, $photos));
        }

        return view('service_report')
            ->with('prints', $print);
    }

    public function map(Request $request){
        $coordinates = Services::query()
            ->whereIn('services.id', $request->ids)
            ->join('service_type as type', 'services.service_type_id', '=', 'type.id')
            ->join('address as adr', 'services.address_id', '=', 'adr.id')
            ->get([
                'services.id',
                'service_description',
                'type',
                'address',
                'n',
                'lat',
                'lng'
            ]);
        return view('map')
            ->with('coordinates', $coordinates);
    }

}
