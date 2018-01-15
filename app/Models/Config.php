<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;

class Config extends Model
{
    protected $table = 'admin_config';
    //
    protected $guarded = [];

    public static function with($relation){
        return new static();
    }
    public function findOrFail($id){
        $data = static::pluck('value','name')->toArray();
        return static::newModelInstance($data);
    }

    public static function getIds(){
        return static::pluck('id');
    }

    public static function setConfig($data){
        $deletes = ['_method','_token'];
        $adds = ['new_display_name','new_name','new_value'];

        $edits = app('request')->except(array_merge($deletes,$adds));
        $adds = app('request')->only($adds);
        $f1 = static::updateConfig($edits);
        $f2 = static::newConfig($adds);
        return $f1 && $f2;

    }


    public static function updateConfig($data){
         collect($data)->each( function ($item,$key){
            $rs = static::where('name',$key)->update(['value'=>$item]);
            if (!$rs){
                return false;
            }
        });
         return true;
    }

    public static function newConfig($data){
        $data = collect($data)->mapWithKeys(function ($item,$key){
            return [str_replace('new_','',$key)=>$item];
        })->filter();
        return $data->count() == 3 ? static::create($data->toArray()) : true;
    }

    public static function   getNames(){
        return static::pluck('name','display_name');
    }
}
