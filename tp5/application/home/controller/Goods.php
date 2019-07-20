<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Goods extends Controller
{
    public function lst(Request $request, $cid)
    {
        //dump($cid);
        // 根据cid查tb_spu表, cid3字段=$cid
        // 需要执行的sql语句如下
        // select * from tb_spu as p join tb_sku as k on p.id=k.spu_id limit 10
        $spus = \think\Db::table('tb_spu')
            ->alias('p')
            ->where('cid3', $cid)
            ->join('tb_sku k', 'p.id=k.spu_id')
            ->paginate(10);
        // 将一个tp查询结果集collection对象转换为数组
        //dump($spus->toArray());exit;

        return view('lst', ['spus' => $spus]);
    }

    public function detail(Request $request, $id)
    {
        // 根据id查sku表
        $sku = \think\Db::table('tb_sku')
            ->find($id);
        //dump($sku);exit;

        $spu = \think\Db::table('tb_spu')
            ->find($sku['spu_id']);

        $spu_detail = \think\Db::table('tb_spu_detail')
            ->where('spu_id', $sku['spu_id'])
            ->find();
        //dump($spu_detail);

        $own_spec = json_decode($sku['own_spec'], true); // {"机身颜色":"金","内存":"4GB","机身存储":"32GB"}
        //dump($own_spec);exit;
        // 渲染模板
        $data = [
            'sku' => $sku,
            'spu' => $spu,
            'spu_detail' => $spu_detail,
            'own_spec' => $own_spec
        ];
        return view('detail', $data);
    }
}
