<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Goods extends Controller
{
    public function page(Request $request)
    {
        // 1. 接收数据
        //dump($request->param());
        $key = $request->param('key', '');
        $saleable = $request->param('saleable', 'true');
        $saleable = $saleable == 'true' ? 1 : 0;
        $page = $request->param('page', 1);
        $rows = $request->param('rows', 5);

        // 2. 构建sql查询
        $spus = \think\Db::table('tb_spu')
            ->where('saleable', $saleable)
            ->whereLike('title', "%{$key}%")
            ->page($page, $rows)
            ->select();
        //dump($spus);

        $items = [];
        if (!empty($spus)) {
            // 遍历
            foreach ($spus as $row) {
                $item['id'] = $row['id'];
                $item['title'] = $row['title'];
                $cname = Db::table('tb_category')
                    ->where('id', 'in', [$row['cid1'], $row['cid2'], $row['cid3']])
                    ->column('name');
                //dump($cname);
                $item['cname'] = implode('/', $cname); // 手机/手机通讯/手机

                $bname = Db::table('tb_brand')
                    ->where('id', $row['brand_id'])
                    ->value('name');
                $item['bname'] = $bname;

                $items[] = $item;
            }
        }

        //dump($items);
        $total = Db::table('tb_spu')->count();
        $totalPage = ceil($total / $rows);

        $data = [
            'total' => $total,
            'totalPage' => $totalPage,
            'items' => $items
        ];

        return json($data);
    }

    public function cate_brand(Request $request, $cid)
    {
        /*
        // 1.根据cid, 查找中间表tb_category_brand, 得到brand_id
        $brand_ids = Db::table('tb_category_brand')
                    ->where('category_id', $cid)
                    ->column('brand_id');
        
        // 2.再根据brand_id 查找brand表, 得到id name
        $brands = Db::table('tb_brand')
                    ->field('id, name')
                    ->whereIn('id', $brand_ids)
                    ->select();
        //dump($brands);
        */
        $brands = Db::table('tb_brand')
            ->field('id, name')
            ->whereIn('id', function ($query) use ($cid) {
                $query->table('tb_category_brand')->where('category_id', $cid)->field('brand_id');
            })
            ->select();


        return json($brands);
    }
}
