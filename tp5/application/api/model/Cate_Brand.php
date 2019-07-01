<?php

namespace app\api\model;

use think\Model;

class Cate_Brand extends Model
{
    protected $table = "tb_category_brand";

    public function add($cid, $bid)
    {
        // 数组
        // ['category_id'=>$cid, 'brand_id'=>$bid]
        self::create(['category_id' => $cid, 'brand_id' => $bid]);
    }

    /**
     * Undocumented function
     *
     * @param [int] $bid 品牌id
     * @param [string] $cids (76,77)
     * @return void
     */
    public function brand_cates($bid, $cids)
    {
        foreach (explode(',', $cids) as $cid) {
            self::create(['brand_id' => $bid, 'category_id' => $cid]);
        }
    }
}
