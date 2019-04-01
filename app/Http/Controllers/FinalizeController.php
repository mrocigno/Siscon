<?php

namespace App\Http\Controllers;

use App\DistributedServices;
use App\FinalizedServices;
use App\Photos;
use App\Repositories\ImageRepository;
use App\Services;
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


    public function endService(Request $request, ImageRepository $img){
        $image = $request->img;
        $id = $request->id;

        $ds = DistributedServices::findOrFail($id);
        $service = Services::query()->findOrFail($ds->service_id);
        $service->status_id = 1;
        $service->save();

        $fs = FinalizedServices::query()->where('distributed_service_id', $id)->first();
        if(!$fs){
            $fs = FinalizedServices::create([
                'distributed_service_id' => $id
            ]);
        }

        $imgLink = $img->saveB64("img/services/" . $fs->id . "/" , $image);

        Photos::create([
            'finalized_service_id' => $fs->id,
            'link' => $imgLink
        ]);

        return $imgLink;
    }
}
