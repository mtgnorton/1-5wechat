<?php
namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;

class CategoryController extends Controller{

    public function index(){

        $rs = Category::select('title','id')->get();

        return $rs;
    }

    public function getPost($id){
        DB::connection()->enableQueryLog();
        $category = Category::with('posts.tags')->findOrFail($id);

        $rs =  $category->posts()->select(DB::raw("id,title,DATE_FORMAT(updated_at, '%Y-%m-%d') as time"))->get();

        foreach ($rs as $post) {
           
         $post->tags   = $post->tags()->pluck('name');

        }
        return rsSuccess($rs);
    }
}