<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Brands;

class Brand extends Controller
{
    public function page(Request $request)
    {
        // 解析GET参数, 并给默认值
        $page = $request->param('page', 1);
        $rows = $request->param('rows', 5);
        $sort = $request->param('sortBy', 'id');
        $desc = $request->param('desc', 'asc');
        $desc = ($desc == 'true') ? 'desc' : 'asc';
        $key  = $request->param('key', '');

        // 构造数据
        $total = Brands::count();
        $totalPage = ceil($total / $rows);

        $items = Brands::whereLike('name', "%{$key}%")
            ->order($sort, $desc)
            ->page($page, $rows)
            ->select();

        $data = [
            'total' => $total,
            'totalPage' => $totalPage,
            'items' => $items
        ];

        // 返回
        return json($data);
    }

    public function add(Request $request)
    {
        // 1. 获取提交的参数
        //dump($request->param());

        // 2. 根据提交的数据, 添加到brands表中
        $brand = Brands::create($request->param());

        $cids = $request->param('cids');
        // 3. 向关联的表category_brand中添加数据
        // cids 76, 77
        foreach (explode(',', $cids) as $cid) {
            $data = ['category_id' => $cid, 'brand_id' => $brand->id];
            Db::table('tb_category_brand')->insert($data);
        }
        // 4. 返回结果, 当然可以加入其它的判断, 这里就不演示了
        return json($brand, '201');
    }

    public function upload(Request $request)
    {
        // 1. 获取上传的文件, file是name属性的值
        $file = request()->file('file');
        // 2. 移动到框架应用根目录/public/uploads 目录下
        $info = $file->move('./uploads');

        $str = "http://www.tp.com/uploads/" . $info->getSaveName();

        if ($info) {
            return str_replace("\\", "/", $str);
        }
    }
}
