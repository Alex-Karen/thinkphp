<?php

namespace app\common\model;

use think\Model;

class Articles extends Model
{
    // 和栏目关联  属于关系
    public function cate()
    {
        //                     关联模型        本模型中关联到关联模型中的外键字段名
        return $this->belongsTo(Cates::class, 'cates_id');
    }
}
