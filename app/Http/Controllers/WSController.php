<?php

namespace App\Http\Controllers;

use App\Repositories\ImageRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class WSController extends Controller{
    public function storeImg(Request $request, ImageRepository $img){
        $image = $request->img;
        $id = $request->id;
        return $img->saveB64("img/services/$id/" , $image);
    }
}
