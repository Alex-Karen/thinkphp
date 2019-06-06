<?php

namespace app\index\controller;

use think\Controller;
use think\Db as mdb;

class Db extends Controller
{
    public function index()
    {
        /*return config('database.database');*/

        /*$sql = "select * from tp_articles where id=?";
        return mdb::query($sql, [102]);*/

        $data = ['title' => 'bar', 'desn' => 'demo', 'body'=> 'body'];

        /*mdb::table('tp_articles')->insert($data);
        mdb::name('articles')->insert($data);
        db('articles')->insert($data);*/

        /*mdb::name('articles')->insertAll($data); //添加多条数据 array
        db('articles')->insertAll($data);*/


    }
}
