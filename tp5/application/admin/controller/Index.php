<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return view('admin@index/index');
    }

    public function welcome()
    {
        return view('admin@index/welcome');
    }
}
