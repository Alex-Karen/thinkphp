# Thinkphp学习

## Thinkphp

### composer

PHP中用来管理依赖关系的工具 - 仓库地址: https://packagist.org/

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

	php -m | grep gd
	
install thinkphp

	composer create-project topthink/think tp5

## restful

## vue
