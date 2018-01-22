<?php

use App\Models\Post;

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
