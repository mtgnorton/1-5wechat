<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Admin\Services\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $movieService;

    public function __construct(TestService $movieService){
        $this->movieService = $movieService;
    }

    public function index()
    {

        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->movieService->grid());
        });
    }

    public function create(){
        return Admin::content(function (Content $content)  {

            $content->header('header');
            $content->description('description');

            $content->body($this->movieService->form());
        });
    }

    public function store(Request $request){
        dump($request->all());
        exit;
    }
}
