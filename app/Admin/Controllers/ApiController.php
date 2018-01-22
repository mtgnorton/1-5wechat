<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ApiController extends Controller{

    public function categories(){

        $rs = Category::select('id','title as text')->get();

        return $rs;
    }
}