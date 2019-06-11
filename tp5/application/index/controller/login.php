<?php

namespace app\index\controller;

use think\Controller;

class login extends Controller
{
    public function index()
    {
        return view('index@login/index');
    }
}
