<?php
namespace app\home\controller;

class Index
{
    public function index()
    {
        // 显式的调用父类的构造方法
        // parent::__construct();

        // 获取分类的数据
        $cates = \think\Db::table('tb_category')
            ->select();
        // 分配到模板中
        // $this->assign('cates', $cates);
        return view('home@index/index')->assign('cates', $cates);
    }
}
