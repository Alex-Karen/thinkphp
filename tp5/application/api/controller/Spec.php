<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class Spec extends Controller
{
    public function index(Request $request, $cid)
    {
        $spec = \think\Db::table('tb_specification')
            ->where('category_id', $cid)
            ->value('specifications');

        return $spec;
    }
}
