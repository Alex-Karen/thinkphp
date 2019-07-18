<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;



Route::group('api', function() {
    Route::get('/item/category/list', 'api/Category/list');
    Route::get('/item/brand/page', 'api/Brand/page');

    Route::post('/item/brand', 'api/Brand/add');
    Route::put('/item/brand', 'api/Brand/upd');

    Route::post('/upload', 'api/Brand/upload');

    Route::get('/item/brand/cates/:bid', 'api/Brand/cates');

    Route::get('/item/spec/:cid', 'api/Spec/index');

    Route::get('/item/spu/page', 'api/Goods/page');

    Route::get('/item/cate_brand/:cid', 'api/Goods/cate_brand');
    
})->allowCrossDomain();

Route::get('/', '@index/index/index');

// include route_path(). '/admin/admin.php';

/*Route::get('login', '@index/login/index')->name('login/index');
Route::post('login', '@index/login/index')->name('login/index');*/

//Route::get('index', '@index/index/index')->name('index');

/*Route::get('req/:id', '@index/index/req')->name('index/index/req');
Route::post('req/:id', '@index/index/req')->name('index/index/req');
Route::put('req/:id', '@index/index/req')->name('index/index/req');
Route::delete('req/:id', '@index/index/req')->name('index/index/req');

Route::group(['prefix'=> '@index/index/'], function() {
    Route::get('req2/[:id]', 'req2')->name('index/index/req2');
    Route::post('req2', 'req2')->name('index/index/req2');
    Route::put('req2', 'req2')->name('index/index/req2');
    Route::delete('req2', 'req2')->name('index/index/req2');
});*/

//Route::get('abc', '@index/index/demo')->name('indexA');

/*路由分组*/
/* Route::group('admin', function () {
    Route::get('login', function () {
        return 'login';
    });
    Route::get(':id', function (int $id) {
        return $id;
    });
})->prefix('admin/')->pattern(['id' => '\d+']);

Route::group('blog', function () {
    Route::get(':id', 'read');
    Route::post(':id', 'update');
    Route::delete(':id', 'delete');
})->prefix('blog/')->ext('html')->pattern(['id' => '\d+']);
*/

/*
//php7新特性 标量声明 性能提高4倍
Route::get('/dd/:id', function(int $id) {
    return 'demo1' . $id;
});
//正则
Route::get('/bb/:id', function($id) {
    return $id;
})->pattern(['id'=> '\d+']);
//可选参数
Route::get('/ee/[:id]', function($id = 0) {
    return $id;
});
*/

//Route::get('dd', 'index/index/demo');

/*Route::post('/', function() {
    return 'post';
});

Route::put('/', function() {
    return 'put';
});

Route::delete('/', function() {
    return 'delete';
});*/

/*Route::any('/any', function() {
    dump($_SERVER);
});*/

// Route::get('think', function () {
//     return 'hello,ThinkPHP5!';
// });

// Route::get('hello/:name', 'index/hello');

// return [

// ];
