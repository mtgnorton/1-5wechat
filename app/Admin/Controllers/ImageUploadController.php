<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller{

    public function upload(Request $request){
        $imageKey = array_first($request->keys()) ;
        $path = $request->{$imageKey}->store('',['disk'=>'editor']);
        if ($path){
            $url = Storage::disk('editor')->url($path);
            $path =parse_url($url,PHP_URL_PATH);
            $result = [
                'errno'=>0,
                'data'=>[
                    $path
                ]
            ];
        }else{
            $result = [
                'errno'=>'图片上传出错'
            ];
        }
     return $result;
    }
}