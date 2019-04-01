<?php

namespace App\Http\Controllers;

use App\Address;
use App\Applicants;
use App\Delivery;
use App\Polo;
use App\ServiceType;
use App\Services;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Excel;
use Validator, Redirect, Input, Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class ImportController extends Controller {
    
    public function index(){
        $serviceTypes = ServiceType::query()->where('company_id', Auth::user()->company_id)->get();
        $applicants = Applicants::query()->where('company_id', Auth::user()->company_id)->get();
        $polos = Polo::query()->where('company_id', Auth::user()->company_id)->get();
        return view('add_services')
            ->with('serviceTypes', $serviceTypes)
            ->with('applicants', $applicants)
            ->with('polos', $polos);
    }
    
    public function importPlan(Request $request, ImageRepository $repository){
        $rules = [
            'file' => 'required'
        ];
        
        $messages = [
            'required' => 'Importe uma planilha'
        ];
        
        $fields = [
            'file' => $request->file
        ];
        
        $validator = Validator::make($fields, $rules, $messages);
        if($validator->fails()){
            return Redirect::back();
        }else{
            $tempFile = $repository->saveTempFile($request->file);
            return Redirect::to('adicionar/planilha')
                ->with('localPath', $tempFile['localPath'])
                ->with('name', $request->file->getClientOriginalName());
        }
    }

    public function showPlan(){
        try{
            $localPath = session()->get('localPath');
            $results = Excel::load($localPath)->get()->toArray();
            $titles = [];
            $i = 0;
            foreach ($results[0] as $key => $values){
                ++$i;
                array_push($titles,"$key");
            }
            $fileVles = [
                'name' =>  session()->get('name'),
                'localPath' => $localPath
            ];
            $applicants = Applicants::orderBy('name','asc')->where('company_id', Auth::user()->company_id)->get();
            $serviceType = ServiceType::orderBy('type','asc')->where('company_id', Auth::user()->company_id)->get();
            $polos = Polo::orderBy('polo','asc')->where('company_id', Auth::user()->company_id)->get();
            return view('import_view_plan')
                ->with('rows',$results)
                ->with('file', $fileVles)
                ->with('polos', $polos)
                ->with('titles', $titles)
                ->with('applicants', $applicants)
                ->with('serviceType', $serviceType);
        }catch (\Exception $e){
            return Redirect::back()
                ->with('xlsxMessage', 'Erro ao abrir planilha: ' . $e->getMessage());
        }
    }

    public function saveManually(Request $request){
        $rules = [
            'solicitante' => 'required',
            'data' => 'required',
            'tipo' => 'required',
            'polo' => 'required',
            'endereco' => 'required',
            'n' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'cep' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ];

        $messages = [
            'required' => 'Preencha o campo :attribute'
        ];

        $fileds = [
            'solicitante' => $request->applicant,
            'data' => $request->date_received,
            'tipo' => $request->service_type,
            'polo' => $request->polo,
            'endereco' => $request->address,
            'n' => $request->n,
            'cidade' => $request->city,
            'uf' => $request->uf,
            'cep' => $request->zip_code,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
        ];

        $validator = Validator::make($fileds, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)
                ->withInput(Input::all());
        }else{
            $data = [
                'address' => $request->address,
                'n' => $request->n,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'uf' => $request->uf,
                'zip_code' => $request->zip_code,
            ];

            $address = Address::where('address', $request->address)->first();
            if (!$address)
                $address = Address::create($data);

            $delivery = Delivery::query()
                ->where('company_id', Auth::user()->company_id)
                ->where('name', 'Adicionados manualmente')
                ->first();
            $data = [
                'company_id' => Auth::user()->company_id,
                'identifier' => $request->identifier,
                'date_received' => $request->date_received,
                'service_type_id' => $request->service_type,
                'address_id' => $address->id,
                'n' => $request->n,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'service_description' => $request->description,
                'applicant_id' => $request->applicant,
                'polo_id' => $request->polo,
                'delivery_id' => $delivery->id,
                'status_id' => 5,
            ];
//            var_dump($data);
            Services::create($data);
            return Redirect::back()
                ->with('message', 'Serviço adicionado com sucesso');
        }
    }

    public function save(Request $request){
        $rules = [
            'remessa' => 'required|max:30',
            'solicitante' => 'required_without:colSol',
            'colSol' => 'required_without:solicitante',
            'data' => 'required_without:colData',
            'colData' => 'required_without:data',
            'tipo' => 'required_without:colTipo',
            'colTipo' => 'required_without:tipo',
            'polo' => 'required_without:colPolo',
            'colPolo' => 'required_without:polo',
            'endereco' => 'required_without:colEndereco',
            'colEndereco' => 'required_without:endereco',
            'cidade' => 'required_without:colCidade',
            'colCidade' => 'required_without:cidade',
            'uf' => 'required_without:colUf',
            'colUf' => 'required_without:uf'
        ];

        $messages = [
            'required' => 'Selecione um :attribute'
        ];

        $fileds = [
            'remessa' => $request->name,
            'solicitante' => $request->applicant,
            'colSol' => $request->colApplicant,
            'data' => $request->dateReceive,
            'colData' => $request->colDateReceive,
            'tipo' => $request->serviceType,
            'colTipo' => $request->colServiceType,
            'polo' => $request->polo,
            'colPolo' => $request->colPolo,
            'endereco' => $request->address,
            'colEndereco' => $request->colAddress,
            'cidade' => $request->city,
            'colCidade' => $request->colCity,
            'uf' => $request->uf,
            'colUf' => $request->colUf
        ];

        $validator = Validator::make($fileds, $rules, $messages);
        if($validator->fails()){
            return Redirect::back()
                ->with('localPath', $request->localPath)
                ->with('name', $request->name)
                ->withInput(Input::all())
                ->withErrors($validator);
        }else{
            return $this->saveServices($request);
        }
    }

    private function saveServices(Request $request){
        try{
            $results = Excel::load($request->localPath)->get()->toArray();
            $companyId = Auth::user()->company_id;

            $delivery = Delivery::create([
                'company_id' => $companyId,
                'name' => $request->name,
                'removable'     => true,
                'num_services' => count($results)
            ]);

            foreach ($results as $row){
                $identifier = (
                ($request->identifier == "")?
                    ($request->colIdentifier == ""? "" : $row[$request->colIdentifier]) :
                    $request->identifier
                );

                $dateReceived = (
                    ($request->dateReceive == "")?
                        ($request->colDateReceive == ""? "" : $row[$request->colDateReceive]) :
                        $request->dateReceive
                );

                $serviceDescr = (
                    ($request->serviceDescr == "")?
                        ($request->colServiceDescr == ""? "" : $row[$request->colServiceDescr]) :
                        $request->serviceDescr
                );

                $pgGuia = (
                    ($request->pgGuia == "")?
                        ($request->colPgGuia == ""? "" : $row[$request->colPgGuia]) :
                        $request->pgGuia
                );

                $street = (
                ($request->address == "")?
                    ($request->colAddress == ""? "" : $row[$request->colAddress]) :
                    $request->address
                );

                $city = (
                ($request->city == "")?
                    ($request->colCity == ""? "" : $row[$request->colCity]) :
                    $request->city
                );

                $uf = (
                ($request->uf == "")?
                    ($request->colUf == ""? "" : $row[$request->colUf]) :
                    $request->uf
                );

                if($request->concat == ""){
                    //Não concatenado
                    $n = $request->$row[$request->colN] . ($request->colCompl == ""? "": " " . $row[$request->colCompl]);
                } else {
                    //Concatenado
                    $explodedAddress = explode(" ", $street);
                    $street = "";
                    if(is_numeric($explodedAddress[count($explodedAddress) - 1])){
                        $n = $explodedAddress[count($explodedAddress) - 1];
                        for ($i = 0; $i < count($explodedAddress) - 1; $i++){
                            $street .= $explodedAddress[$i] . " ";
                        }
                    } elseif (is_numeric($explodedAddress[count($explodedAddress) - 2])){
                        $n = $explodedAddress[count($explodedAddress) - 2] . " " . $explodedAddress[count($explodedAddress) - 1];
                        for ($i = 0; $i < count($explodedAddress) - 2; $i++){
                            $street .= $explodedAddress[$i] . " ";
                        }
                    } else {
                        $n = "0";
                        for ($i = 0; $i < count($explodedAddress); $i++){
                            $street .= $explodedAddress[$i] . " ";
                        }
                    }
                }

                $query = Address::where('address', $street)->first();
                if ($query)
                    $address = $query->id;
                else {
                    $query = Address::create([
                        'address' => trim($street),
                        'city' => $city,
                        'uf' => $uf
                    ]);
                    $address = $query->id;
                }

                $unique = $request->applicant;
                if($unique == ""){
                    $field = $row[$request->colApplicant];
                    if($field != ""){
                        $query = Applicants::where('name', $field)->where('company_id', $companyId)->first();
                        if($query)
                            $applicant = $query->id;
                        else {
                            $query = Applicants::create([
                                'company_id' => $companyId,
                                'name' => $field
                            ]);
                            $applicant = $query->id;
                        }
                    }else
                        $applicant = "";
                }else
                    $applicant = $unique;

                $unique = $request->polo;
                if($unique == ""){
                    $field = $row[$request->colPolo];
                    if($field != ""){
                        $query = Polo::where('polo', $field)->where('company_id', $companyId)->first();
                        if($query)
                            $polo = $query->id;
                        else {
                            $query = Polo::create([
                                'company_id' => $companyId,
                                'polo' => $field
                            ]);
                            $polo = $query->id;
                        }
                    }else
                        $polo = "";
                }else
                    $polo = $unique;

                $unique = $request->serviceType;
                if($unique == ""){
                    $field = $row[$request->colServiceType];
                    if($field != ""){
                        $query = ServiceType::where('type', $field)->where('company_id', $companyId)->first();
                        if($query)
                            $serviceType = $query->id;
                        else {
                            $query = ServiceType::create([
                                'company_id' => $companyId,
                                'type' => $field
                            ]);
                            $serviceType = $query->id;
                        }
                    }else
                        $serviceType = "";
                }else
                    $serviceType = $unique;

                $data = [
                    'company_id' => $companyId,
                    'date_received' => $dateReceived,
                    'identifier' => $identifier,
                    'service_type_id' => $serviceType,
                    'address_id' => $address,
                    'n' => $n,
                    'service_description' => $serviceDescr,
                    'pg_guia' => $pgGuia,
                    'delivery_id' => $delivery->id,
                    'applicant_id' => $applicant,
                    'polo_id' => $polo,
                    'status_id' => 6
                ];

                Services::create($data);
            }

            return Redirect::to('adicionar/formatar-enderecos/'. $delivery->id);

        }catch (\Exception $e){
            return Redirect::to('adicionar')
                ->with('xlsxMessage', 'Erro ao abrir planilha: ' . $e->getMessage());
        }
    }

    public function formatAddress($idRemessa){
        $addresses = $this->getAddresses($idRemessa);
        return view('format_address')
            ->with('addresses', $addresses);
    }

    public function getAddresses($idRemessa){
        return Services::orderBy('services.id', 'asc')
            ->join('address as adr', 'adr.id', '=', 'services.address_id')
            ->where('services.company_id', Auth::user()->company_id)
            ->where('services.lat', "=", 0)
            ->where('services.lng', "=", 0)
            ->where('delivery_id', $idRemessa)
            ->get([
                'services.id as sid',
                'services.n as n',
                'adr.address as address',
                'services.lat as lat',
                'services.lng as lng',
                'adr.formatted_address as formatted_address',
                'adr.reference_address as reference_address',
                'adr.neighborhood as neighborhood',
                'adr.city as city',
                'adr.uf as uf',
                'adr.zip_code as zip_code',
            ]);
    }

}


























