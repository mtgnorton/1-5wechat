<?php
namespace App\Admin\Services;

use App\Models\Movie;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use App\User;


class TestService extends BaseService {


    public function form(){

      return Admin::form(Movie::class, function(Form $form){

            // 显示记录id
            $form->display('id', 'ID');

            // 添加text类型的input框
            $form->text('title', '电影标题');

            $directors = [
                'John'  ,
                'Smith',
                'Kate' ,
            ];

            $form->select('director', '导演')->options($directors);

            // 添加describe的textarea输入框
            $form->textarea('describe', '简介');

            // 数字输入框
            $form->number('rate', '打分');
          $form->tab('Basic info', function ($form) {

              $form->text('username');
              $form->email('email');

          })->tab('Profile', function ($form) {

              $form->image('avatar');
              $form->text('address');
              $form->mobile('phone');

          });
            // 添加开关操作
            $form->switch('released', '发布？');
            $form->image('images');
            // 添加日期时间选择框
            $form->datetime('release_at', '发布时间');
            $form->setWidth(6, 2);
            // 两个时间显示
//            $form->display('created_at', '创建时间');
//            $form->display('updated_at', '修改时间');
        });
    }

    public function grid(){
        return  Admin::grid(Movie::class, function(Grid $grid){
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                $filter->equal('title','fadsfa' );
                $filter->equal('rate')->radio([
                    ''   => 'All',
                    0    => 'Unreleased',
                    1    => 'Released',
                ]);
            });


//            $grid->model()->orderBy('id ','desc');
            // 第一列显示id字段，并将这一列设置为可排序列
            $grid->id('ID')->sortable();

            // 第二列显示title字段，由于title字段名和Grid对象的title方法冲突，所以用Grid的column()方法代替
            $grid->column('title')->editable();

            // 第三列显示director字段，通过display($callback)方法设置这一列的显示内容为users表中对应的用户名
            $grid->director('导演')->display(function($userId) {
                return User::find($userId)->name;
            });
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            });
            // 第四列显示为describe字段
            $grid->describe('描述');

            // 第五列显示为rate字段
            $grid->rate()->switch();
            $grid->paginate(10);
            // 第六列显示released字段，通过display($callback)方法来格式化显示输出
//            $grid->released('上映?')->display(function ($released) {
//                return $released ? '是' : '否';
//            });



            // 下面为三个时间字段的列显示
            $grid->release_at()->editable('datetime');
            $grid->created_at();
            $grid->updated_at();

            // filter($callback)方法用来设置表格的简单搜索框
            $grid->filter(function ($filter) {

                // 设置created_at字段的范围查询
                $filter->between('created_at', 'Created Time')->datetime();
            });
        });

    }
}