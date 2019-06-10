<?php
/**
 * Created by PhpStorm.
 * User: xufuhe
 * Date: 2019-06-08
 * Time: 13:31
 */
use think\facade\Route;
Route::group('admin', function() {
    Route::get('login', '@admin/login/index')->name('admin/login/index');
    Route::post('login', '@admin/login/loginHandler')->name('admin/login/index');

    Route::get('up', '@admin/up/index')->name('admin/up/index');
    Route::post('upload', '@admin/up/upload')->name('admin/up/upload');
    Route::delete('del', '@admin/up/del')->name('admin/up/del');

    Route::group(['middleware'=> ['CheckLogin']], function() {
        Route::get('index', '@admin/index/index')->name('admin/index/index');
        Route::get('welcome', '@admin/index/welcome')->name('admin/index/welcome');
    });

});