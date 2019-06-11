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

    public function del(Request $request)
    {
        /*dump($request->param());*/
        $img = dirname(dirname(dirname(__DIR__))) . '/public' . $request->delete('img');
        $ret = ['status' => 1, 'msg' => '删除失败'];
        if (unlink($img)) {
            $ret = ['status' => 0, 'msg' => '删除成功'];
        }
        return json($ret);
    }
}
