<?php

namespace app\index\controller;

//use \think\facade\Request;
use \think\Controller;
use \think\Request;
class Index extends Controller
{
    public function index()
    {
        /*return 'PHP是世界上最好的语言';*/

        /*$result = ['status'=> 200, 'message'=>"成功"];
        return json($result, 201, ['username'=>'demo']);*/

        /*return redirect(url('/req2'), ['name', 'test']);*/

        /*return $this->fetch();*/

        /*return view('index@index/index', ['aa'=> 'bb']);*/
        $aa = '123';
        $bb = ['name'=>'demo', 'age'=>14];
        return view('index@index/index', compact('aa','bb'));
    }

    public function demo()
    {
        dump($_SERVER);
    }

    public function req2(Request $req, $id = 0)
    {
        dump(input('get.'));
        dump($id);
        dump(input('post.name', 'demo'));
        dump(input('param.'));
        dump(input(''));
        dump(input('?key')); //判断key 是否存在
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
