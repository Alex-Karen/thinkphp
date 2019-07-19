<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Login extends Controller
{
    public function register(Request $request) {
        return view('home@login/register');
    }
}
