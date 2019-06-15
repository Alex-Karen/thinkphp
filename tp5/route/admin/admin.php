<?php
/**
 * Created by PhpStorm.
 * User: xfh
 * Date: 2019-06-08
 * Time: 13:31
 */
use think\facade\Route;
Route::group(['prefix' => 'admin/', 'name' => 'admin'], function() {
    Route::get('login', 'login/index')->name('admin/login/index');
    Route::post('login', 'login/loginHandler')->name('admin/login/index');

    Route::get('up', 'up/index')->name('admin/up/index');
    Route::post('upload', 'up/upload')->name('admin/up/upload');
    Route::delete('del', 'up/del')->name('admin/up/del');

    Route::group(['middleware'=> ['CheckLogin']], function() {
        Route::get('index', 'index/index')->name('admin/index/index');
        Route::get('welcome', 'index/welcome')->name('admin/index/welcome');
        /*资源路由*/
        Route::resource('art', 'article');
    });

});