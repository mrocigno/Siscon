<?php

namespace App\Http\Controllers;

use App\DistributedServices;
use Illuminate\Http\Request;
use Auth, DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InitController extends Controller{
    
    public function index() {
        return view('inicio');
    }

    public function getReportByUsers(Request $request){
        $geral = DistributedServices::query()
            ->groupBy(['distributed_services.user_id', 'distributed_services.distributed_date'])
//            ->where('u.company_id', Auth::user()->company_id)
            ->where('distributed_services.distributed_date', '>=', $request->start)
            ->where('distributed_services.distributed_date', '<=', $request->end)
            ->join('users as u', 'distributed_services.user_id', '=', 'u.id')
            ->get([
                'u.name',
                'u.id as user_id',
                'distributed_date',
                DB::raw('count(*) as total')
            ]);

        $query = [];
        foreach ($geral as $row){
            $data = DistributedServices::query()
                ->groupBy(['distributed_services.user_id', 'distributed_services.distributed_date', 'distributed_services.status_id'])
                ->where('u.company_id', Auth::user()->company_id)
                ->where('distributed_services.user_id', $row->user_id)
                ->where('distributed_services.distributed_date', $row->distributed_date)
                ->join('users as u', 'distributed_services.user_id', '=', 'u.id')
                ->join('status as s', 'distributed_services.status_id', '=', 's.id')
                ->get([
                    's.status',
                    's.id as status_id',
                    DB::raw('count(*) as total')
                ]);

            array_push($query, [
                'row' => $row,
                'data' => $data
            ]);
        }

        return view('services.report_user')
            ->with('query', $query);

    }

}
