<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Up extends Controller
{
    public function index()
    {
        return view('admin@up/index');
    }

    public function upload(Request $request)
    {
        $file = $request->file('pic');
        $info = $file->move('./uploads');
        if ($info) {
            $saveName = '/uploads/' . str_replace('\\', '/', $info->getSaveName());
            return json(['status' => 0, 'msg' => $saveName]);
        } else {
            return json(['status' => 1, 'msg' => $file->getError()]);
        }
    }
}
