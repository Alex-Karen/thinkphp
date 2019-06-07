<?php

namespace app\admin\controller;

use app\admin\validate\UserValidate;
use think\Controller;
use think\Request;

class Login extends Controller
{
    public function index()
    {
        return view('admin@login/index');
    }

    public function loginHandler(Request $request)
    {
        $input = $request->post();

        $ret = $this->validate($input, UserValidate::class);
        if (true !== $ret) {
            $this->error('请重新登录');
        }

        $ret = model('users')->checkUser($input);
        if (true == $ret) {
            return 'success';
        } else {
            $this->error('用户名或密码错误');
        }
    }
}
