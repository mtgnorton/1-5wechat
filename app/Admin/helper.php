<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


function getConfig($name=null){
    $data = Cache::remember('site_config',1, function (){
       return DB::table('admin_config')->pluck('value','name');
    });
    if (is_null($name)){
        return $data;
    }else{
        return $data[$name];
    }

}