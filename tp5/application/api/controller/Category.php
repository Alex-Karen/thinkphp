<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Cates;
class Category extends Controller
{
    public function list(Request $request) {
        $cates = Cates::where('parent_id', $request->pid)
            ->select();
        // 返回json数据
        return json($cates);
    }
}
