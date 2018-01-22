<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->get('/api/categories','ApiController@categories');
    $router->resource('test', 'TestController');
    $router->get('/config','ConfigController@edit');
    $router->put('/config','ConfigController@update');
    $router->post('/wangeditor/upload','ImageUploadController@upload');
    $router->resource('wechat/menu', 'MenuController', ['except' => ['create']]);
    $router->resource('tags', 'TagController');
    $router->resource('posts', 'PostController');
    $router->resource('categories', 'CategoryController');

});
