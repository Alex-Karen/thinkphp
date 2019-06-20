<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Cates;
class Category extends Controller
{
    public function list(Request $request) {
        $cates = Cates::field('id, name, parent_id as parentId, is_parent as isParent, sort')
                        ->where('parent_id', $request->pid)
                        ->select();

        // // 设置响应头
        // $headers = [
        //     'Access-Control-Allow-Origin' => '*',
        //     'Access-Control-Allow-Methods' => '*',
        //     'Access-Control-Allow-Credentials' => 'false',
        //     'Access-Control-Allow-Headers' => 'content-type'
        // ];
        // 返回json数据
        // return json($cates)->header($headers);
        return json($cates);
    }
}
