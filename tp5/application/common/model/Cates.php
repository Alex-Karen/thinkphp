<?php

namespace app\common\model;

use think\Model;

class Cates extends Model
{
    // 关联文章表 一对多
    public function arts()
    {
        //                   关联模型          关联模型中对应 到本模型中的字段名
        return $this->hasMany(Articles::class, 'cates_id');
    }
}
