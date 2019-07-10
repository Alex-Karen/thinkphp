<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Brands;
use app\api\model\Cate_Brand;
use think\Db;

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
        // 1. 解析请求的数据
        //dump($request->param());

        // 2. 添加到brand表, 拿到自增的id
        /* create方法, 自动过滤不属于表字段的信息
         * @param array 需要添加的数据
         * @return obj 新添加的模型对象, 可以通过$brand->id拿到自增的id值
        */
        $brand = Brands::create($request->param());

        // 3. 维护中间表, 向中间表添加若干条记录
        $cids = $request->param('cids'); // 76,77

        $cate_brand = new Cate_brand();
        $cate_brand->brand_cates($brand->id, $cids);

        // 返回json数据, 201状态码
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

    public function cates(Request $request, $bid)
    {
        // 1. 根据bid查询中间表, 得到category_id
        /*$cids = \think\Db::table('tb_category_brand')
            ->where('brand_id', $bid)
            ->column('category_id');
        
        //dump($cids);
        // 2. 根据category_id查询tb_category表, id字段name字段
        $cates = [];
        foreach ($cids as $cid) {
            $cates[] = \think\Db::table('tb_category')
                        ->field('id, name')
                        ->find($cid); // where id in 3,76
        }*/
        // SELECT `id`, `name` FROM `tb_category` WHERE `id` IN 
        // (SELECT `category_id` FROM `tb_category_brand` WHERE `brand_id` = 325409)
        $cates = Db::table('tb_category')
            ->field('id, name')
            ->where('id', 'IN', function ($query) use ($bid) {
                $query->table('tb_category_brand')->where('brand_id', $bid)->field('category_id');
            })->select();

        //dump($cates);
        return json($cates);
    }

    public function upd(Request $request)
    {
        // 1. 更新品牌表
        Brands::update($request->param());
        // 2. 更新中间表
        // 这里存在一点逻辑小bug, 当更新的分类是新添加时会怎样
        $cids = $request->param('cids');
        foreach (explode(',', $cids) as $cid) {
            Db::table('tb_category_brand')
                ->where('brand_id', $request->id)
                ->update(['category_id' => $cid]);
        }
    }
}
