<?php
/**
 * Created by PhpStorm.
 * User: mtg
 * Date: 2018/1/15
 * Time: 10:03
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Illuminate\Database\Eloquent\Model;


class ConfigController extends Controller
{
    public function edit()
    {

        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');
            $ids = Config::getIds();
            $content->body($this->form()->edit(1));
        });
    }

    public function form(){

        return Admin::form(Config::class, function (Form $form) {
            $form->tab('修改网站设置', function ($form){
                $names = Config::getNames();
                $form->setAction('/admin/config');
                $form->disableReset();
                foreach ($names as $displayName =>$name) {
                    $form->text($name,$displayName);
                }
            })->tab('添加网站设置',function ($form){
                $form->text('new_display_name','显示名称');
                $form->text('new_name','键');
                $form->text('new_value','值');
            });

        });
    }

    public function update(){
        $all= app('request')->all();
        $rs = Config::setConfig($all);
       if ($rs){
           admin_toastr(trans('admin.update_succeeded'));
       }else{
           admin_toastr(trans('admin.update_failed'),'error');
       }
        return redirect('/admin/config');
    }
}