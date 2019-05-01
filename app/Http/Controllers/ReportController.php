<?php

namespace App\Http\Controllers;

use App\ModelsVO\PrintVO;
use App\Photos;
use App\Reports;
use App\Services;
use App\ServiceType;
use App\Utils\StatusUltil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;
use Validator, Input, Redirect, Auth;
use App\Applicants;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportController extends Controller{

    public function add(){
        $types = ServiceType::query()
            ->where('company_id', Auth::user()->company_id)
            ->get(['id','type']);
        return view('admin.views.report_add')
            ->with('types', $types);
    }

    public function store(){
        $inputs = Input::all();
        $companyId = Auth::user()->company_id;
        $serviceType = $inputs['service_type'];

        $validator = Reports::query()
            ->where('company_id', $companyId)
            ->where('service_type_id', $serviceType)
            ->first();

        if($validator){
            return redirect('relatorios/lista')
                ->with('error', 'Este tipo de serviço já tem relatório cadastrado');
        } else {
            $json = [];
            foreach ($inputs['show'] as $row){
                array_push($json, [
                    'name' => $inputs["name_$row"],
                    'value' => $inputs["value_$row"],
                    'type' => $inputs["type_$row"],
                    'default' => isset($inputs["check_$row"])? true : false,
                    'show' => true,
                    'order' => intval($inputs["order_$row"])
                ]);
            }
            usort($json, function ($a, $b){
                return ($a['order'] < $b['order']? -1 : ($a['order'] > $b['order']? 1 : 0));
            });

            $query = Reports::create([
                'service_type_id' => $serviceType,
                'company_id' => $companyId,
                'fields_json' => json_encode($json)
            ]);
            return redirect('relatorios/lista')
                ->with('success', 'Relatório adicionado com sucesso. ID: ' . $query->id);
        }
    }
    
    public function edit($id){
        $types = ServiceType::query()
            ->where('company_id', Auth::user()->company_id)
            ->get(['id','type']);
        $query = Reports::query()->findOrFail($id);
        return view('admin.views.report_edit')
            ->with('types', $types)
            ->with('report', $query);
    }
    
    public function update(){
        $inputs = Input::all();
        $companyId = Auth::user()->company_id;
        $serviceType = $inputs['service_type'];

        $json = [];
        foreach ($inputs['show'] as $row){
            array_push($json, [
                'name' => $inputs["name_$row"],
                'value' => $inputs["value_$row"],
                'type' => $inputs["type_$row"],
                'default' => isset($inputs["check_$row"])? true : false,
                'show' => true,
                'order' => intval($inputs["order_$row"])
            ]);
        }
        usort($json, function ($a, $b){
            return ($a['order'] < $b['order']? -1 : ($a['order'] > $b['order']? 1 : 0));
        });

        $query = Reports::query()->findOrFail($inputs['id']);
        $query->update([
            'service_type_id' => $serviceType,
            'company_id' => $companyId,
            'fields_json' => json_encode($json)
        ]);

        return redirect('relatorios/lista')
            ->with('success', 'Relatório editado com sucesso');
    }

    public function lista(){
        $reports = Reports::orderBy('id','asc')
            ->where('reports.company_id', Auth::user()->company_id)
            ->join('service_type as st', 'reports.service_type_id', '=', 'st.id')
            ->get([
                'reports.id',
                'st.type as service_type',
                'reports.created_at',
            ]);
        return view('admin.views.report_list')->with('reports', $reports);
    }
    
    public function destroy($id){
        if($id != 1){
            $query = Reports::findOrFail($id);
            $query->delete();
            return Redirect::to('relatorios/lista')
                ->with('success', 'Relatorio removido com sucesso');
        } else {
            return Redirect::to('relatorios/lista')
                ->with('error', 'Este relatório não pode ser removido');
        }
    }


    public function printMany(Request $requests){
        $services = Services::query()
            ->groupBy('services.id')
            ->select([
                'services.id as sid',
                'services.service_type_id as stid',
                'services.status_id',
                'services.identifier',
                'services.service_description as description',
                DB::raw("concat(adr.address, ', ' , services.n) as address"),
                'type.type',
                'users.name as user_name',
                'app.name as applicant',
                'fs.id as fid',
                'fs.more_fields_json as json',
                'fs.observation as observation'
            ])
            ->join('address as adr', 'adr.id', '=', 'services.address_id')
            ->join('service_type as type', 'type.id', '=', 'services.service_type_id')
            ->join('applicants as app', 'app.id', '=', 'services.applicant_id')
            ->leftJoin('distributed_services as ds', function ($join){
                $join->on('services.id', '=', 'ds.service_id');
                $join->on('services.status_id', '=', 'ds.status_id');
            })
            ->leftJoin('users', 'users.id', '=', 'ds.user_id')
            ->leftJoin('finalized_services as fs', 'fs.distributed_service_id', '=', 'ds.id')
            ->whereIn('services.id', $requests->ids)
//            ->toSql();
            ->get();


        $print = [];
        foreach ($services as $service){
            $status = StatusUltil::getStatus($service->status_id);
            $photos = Photos::query()->where('finalized_service_id', $service->fid)->get();
            $structure = Reports::query()
                ->where('service_type_id', $service->stid)
                ->where('company_id', Auth::user()->company_id)
                ->first();
            if(!$structure){
                $structure = Reports::query()->findOrFail(1);
            }

            array_push($print, new PrintVO($service, $status, $photos, $structure));
        }

//        var_dump($structure);
        return view('service_report')
            ->with('prints', $print);
    }

}
