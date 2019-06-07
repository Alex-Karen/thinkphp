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
    
    升级 composer self-update

查看命令行下可用扩展

    php -m

### install thinkphp

    composer create-project --prefer-dist topthink/think tp5
    
    php think run

目录

	application 应用目录  mvc 所在的目录，业务代码所写的目录
    application/common  公共模块目录
    application/common/model 公共模块中的模型
    config/app.php  应用的主配置文件
    route/route.php 路由文件
    public 虚拟主机指向的目录  public/static 静态文件所在的目录 可以删除
    thinkphp 框架核心目录，不要修改 
    vendor composer 下载的第三方类库 composer管理的
    composer.json 文件 composer针对于此项目的配置文件
    think  命令行文件 php think

请求生命周期

	用户请求->入口文件index.php->框架引入文件中->框架实现层(引导加载【容器：(说白话)数组】,URL检测，路由的分配)
			->控制器->模型->控制器->视图->返回用户
    路由与控制器之间，我们可以加事件【中间件】

### 路由

将用户的请求按照事先规划的方案提交给指定的控制器和方法来进行处理

url更加友好，美化，安全

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
    Route::group(['method'=>'get', 'name'=> 'aa', 'prefix', 'middleware'], function () {
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

### 请求

	当浏览器向Web服务器发出请求时，它向服务器传递了一个数据块，也就是请求信息。在Thinkphp5.1中，获取请求对象数据，
	是由think\Request类负责，在很多场合下并不需要实例化调用，
	通常使用依赖注入即可，在其它场合（例如模板输出等）则可以使用think\facade\Request静态类操作

参数绑定

	参数绑定是把当前请求的路由参数作为操作方法的参数直接传入，参数绑定并不区分请求类型。

依赖注入
	
	依赖注入是一种软件设计思想，在传统软件中，上层代码依赖于下层代码，当下层代码有所改动时，上层代码也要相应进行改动，
	因此维护成本较高。而依赖注入原则的思想是，上层不应该依赖下层，应依赖接口。意为上层代码定义接口，下层代码实现该接口，
	从而使得下层依赖于上层接口，降低耦合度，提高系统弹性。
    控制反转【IOC】
    依赖注入【DI】

相应

	重定向 redirect();
	
模板
	
	return $this->fetch('index@index/index');

	return view('index@index/index');
	
	return view('index@index/index',compact('aa','arr')); # 推荐写法
	
	全局赋值
	use think\facade\View;
    # 赋值全局模板变量
    View::share('name','value');
    # 或者批量赋值
    View::share(['name1'=>'value','name2'=>'value2']);

## restful

## vue
