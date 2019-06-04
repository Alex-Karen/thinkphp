<?php

namespace app\index\controller;

use think\Controller;

class Demo extends Controller
{
    /*protected $beforeActionList = [
        'demo' => ['index', 'welcome']
    ];*/
    /*protected function demo() {
        echo 'demo<hr>';
    }
    public function welcome() {
        echo 'welcome<hr>';
    }*/

    public function index() {
        // return $this->success('登录成功', url('su'));
        // return $this->success('success', url('su'));
        // return $this->success('success', url('index/index/demo'));
         return $this->success('success', url('indexA'), ['status'=> 1]);
        // return $this->error('错了');
    }
    public function su() {
        return 'success';
    }
}
