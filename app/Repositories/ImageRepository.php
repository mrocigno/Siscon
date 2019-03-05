<?php
namespace App\Repositories;
use Illuminate\Support\Facades\File;
use Image, URL;

class ImageRepository{
    
    public function saveImage($image, $id){
        
        if (!is_null($image)){
            $file = $image;
            $extension = $image->getClientOriginalExtension();
            
            $fileName = time() . random_int(100, 999) .'.' . $extension; 
            $destinationPath = public_path('img/logos/'.$id.'/');
            $url = __DIR__ .'/img/logos/'.$id.'/'.$fileName;
            $fullPath = $destinationPath.$fileName;
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775);
            }
            $image->move($destinationPath , $fileName);
            
            return URL::asset('public/img/logos/' . $id . '/' . $fileName);
        }
        
    }
    
    public function saveTempFile($tmpFile){
        
        if (!is_null($tmpFile)){
            $file = $tmpFile;
            $extension = $tmpFile->getClientOriginalExtension();
            
            $fileName = time() . random_int(100, 999) .'.' . $extension; 
            $destinationPath = public_path('files/temp/');
            $fullPath = $destinationPath.$fileName;
            $localPath = 'public/files/temp/' . $fileName;
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775);
            }
            $tmpFile->move($destinationPath , $fileName);
            
            return [
                'publicPath' => URL::asset('public/files/temp/' . $fileName),
                'localPath' => $localPath
            ];
        }
        
    }
    
}