<?php

namespace app\index\controller;

//use \think\facade\Request;
use \think\Request;

class Index
{
    public function index()
    {
        return 'PHP是世界上最好的语言';
    }

    public function demo()
    {
        dump($_SERVER);
    }

    public function req(Request $req)
    {
        dump($req->get());
        /*
        dump(Request::param('c', 10, 'intval')); //获取任意类型数据
        dump(Request::has('c')); //判断Key是否存在
        dump(Request::only(['id', 'age'])); //获取指定的数据  白名单
        dump(Request::except(['id'])); //排除不用的数据  黑名单*/

        /*dump(Request::get());*/
        /*dump(Request::post());*/
        /*dump(Request::put());*/
        /*dump(Request::delete());*/

        /*dump(Request::isPost());
        dump(Request::isGet());
        dump(Request::isPut());
        dump(Request::isDelete());
        dump(Request::isAjax());*/

        /*dump(Request::server());
        dump(Request::env());
        dump(Request::route());
        dump(Request::file());*/
    }
}
