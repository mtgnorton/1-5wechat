<?php

return [

    //显示的图片类型
    'type'=>[
       'gif','jpg','png'
    ],

    //递归获取path下的所有图片
    'recursion'=> true,

    //图片缓存时间,使用默认缓存
    'cache_time'=>5,

    //使用的文件存储配置如下
//    'uploads' => [
//        'driver' => 'local',
//        'root' => public_path('uploads'),
//        'url' => env('APP_URL').'uploads',
//        'visibility' => 'public',
//    ],
    'disk' =>'admin',

    //默认引入的文件有  'jQuery-2.1.4.min.js','bootstrap.min.js','vue.js','showphotos.js','sweetalert.min.js',如果项目中已经引入,可在下方排出
    'js-except' => [
        'bootstrap',
        'jquery',
        'sweetalert'
    ],
    //默认引入的文件有      'bootstrap.min.css','font-awesome.min.css','sweetalert.css'
    'css-except' => [
        'bootstrap',
        'font-awesome',
        'sweetalert'
    ]
];