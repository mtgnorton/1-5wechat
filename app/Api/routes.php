<?php

use App\Api\Services\MovieService;
use App\Api\Services\TorrentService;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

Route::get('categories', 'CategoryController@index');
Route::get('category_post/{id}', 'CategoryController@getPost');

Route::get('post/{id}', function ($id) {
 
    $post = Post::with(['tags', 'category'])->findOrFail($id);

    $rd = ['title', 'content', 'cover', 'created_at', 'updated_at'];

    $rs = array_intersect_key($post->toArray(), array_flip($rd));

    $rs['tags'] = $post->tags()->pluck('name');
    $rs['category'] = $post->category->title;

    return rsSuccess($rs);

});

Route::get('tags', function (){
    return rsSuccess(Tag::select('name','id')->get()->toArray());

});
Route::get('tag_post/{id}', function ($id){
    $posts =  Tag::with(['posts'])->findOrFail($id)->posts()->select(DB::raw("id,title,DATE_FORMAT(posts.updated_at, '%Y-%m-%d') as time"))->get();
    return rsSuccess($posts->map(function($item){

    $item->tags =  $item->tags()->pluck('name');
    return $item;

    }));
});

Route::get('torrent/{search}/{page}',function($search,$page){
    $service = new TorrentService();
    return rsSuccess($service->get($search,$page));
});

Route::get('movie/{search}',function($search){
    $service = new MovieService();
    return rsSuccess($service->get($search));
});

Route::post('register','AuthController@register');
Route::post('login','AuthController@login');

Route::get('email/verify/{token}',['uses'=>'AuthController@emailVerify','as'=>'email.verify']);