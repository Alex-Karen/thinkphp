<?php

namespace app\home\controller;

use think\Controller;

class Pay extends Controller
{
    public function callback(Request $request)
    {
        // 1. 获取参数
        $data = $request->param();

        // 2. 包含文件
        require_once('./alipay/config.php');
        require_once('./alipay/pagepay/service/AlipayTradeService.php');

        // 3. 实例化对象
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($data);

        if ($result) {
            //验签成功
            return view('paysuccess');
        } else {
            return view('payfail');
        }
    }
}
