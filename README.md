# Thinkphp学习

## Thinkphp

### composer

PHP中用来管理依赖关系的工具 - 仓库地址: `https://packagist.org/`

工作原理

    composer可以去packagist应用市场里边下载软件，但是该市场只给返回软件的地址，

    对应的软件都是在github里边存储的，最终下载的软件是从github返回的

composer install

    curl -sS https://getcomposer.org/installer | php

    mv composer.phar /usr/local/bin/composer

    切换镜像

    composer config -g repo.packagist composer https://packagist.phpcomposer.com

    composer config -g repo.packagist composer https://packagist.laravel-china.org

查看命令行下可用扩展

    php -m

install thinkphp

    composer create-project --prefer-dist topthink/think tp5

### 路由

将用户的请求按照事先规划的方案提交给指定的控制器和方法来进行处理

Thinkphp框架提供了两种路由规则

    1.pathinfo模式

    2.自定义路由规则[推荐]

    进而可以让URL更规范以及优雅，提高网站的安全和网站URL访问的友好度。
    Route类注册使用think\facade\Route类静态调用 think\Route.php
    注：ThinkPHP5.1的路由定义更加对象化，并且默认开启路由（不能关闭），如果一个URL没有定义路由，则采用默认的PATH_INFO 模式访问URL。

    给控制器方法设置好了请求的路由规则后，原来的pathinfo请求则失效，请求就会报异常，只能通过自定义路由规则来请求
	
	php think route:list 查看路由列表

get post put delete any

    any : 任意请求类型

路由分组

    # 分组的嵌套
    Route::group(['method'=>'get'], function () {
        Route::group('blog',function(){
            Route::get(':id', 'read');
            Route::post(':id', 'update');
            Route::delete(':id', 'delete');
        });
    })->pattern(['id' => '\d+']);

### 控制器

使用命令行创建分组

    php think build --module 分组名称

创建控制器

    php think make:controller --plain 模块名/控制器名 (首字母大写)

    --plain 标准控制器 (默认创建的控制器是一个资源控制器，所以一般加上此选项)

前置操作

    可以为某个或者某些操作指定前置执行的操作方法，设置 beforeActionList属性可以指定某个方法为其他方法的前置操作，
    数组键名为需要调用的前置方法名，无值的话为当前控制器下所有方法的前置方法。

## restful

## vue
