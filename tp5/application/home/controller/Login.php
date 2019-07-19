<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Login extends Controller
{
    public function register(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('home@login/register');
        } elseif ($request->method() == 'POST') { }
    }

    public function sendCode(Request $request)
    {
        // 读取配置文件
        $config = [
            'key_id' => 'LTAIaOUFVqaA68DB',
            'key_secret' => 'Jpbna8b0VY8fSbuRxU1wdg0HR0ao8x',
            'sign_name' => '品优购商城', //签名名称
            'code' => 'SMS_150181772', //模板CODE
        ];
        // 实例化对象
        $send = new \Aliyun\Send($config);
        // 生成4位随机数
        $code = mt_rand(1000, 9999);

        $data = [
            'code' => $code,
            'product' => 'xxx'
        ];
        $mobile = $request->phone;

        // 发送数据
        $res = $send->sendSms($mobile, $data);

        // 判断结果
        if ($res === true) {
            return json(['status' => 200, 'msg' => '发送成功', 'data' => $code]);
        } else {
            return json(['status' => 500]);
        }
    }
}
