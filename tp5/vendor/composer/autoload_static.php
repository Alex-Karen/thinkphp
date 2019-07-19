<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit11c41393b7bc63addf13e542cab5c31d
{
    public static $files = array (
        '1cfd2761b63b0a29ed23657ea394cb2d' => __DIR__ . '/..' . '/topthink/think-captcha/src/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'think\\composer\\' => 15,
            'think\\captcha\\' => 14,
            'think\\' => 6,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'A' => 
        array (
            'Aliyun\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'think\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-installer/src',
        ),
        'think\\captcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-captcha/src',
        ),
        'think\\' => 
        array (
            0 => __DIR__ . '/..' . '/topthink/think-image/src',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
        'Aliyun\\' => 
        array (
            0 => __DIR__ . '/..' . '/hao/alidayu/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit11c41393b7bc63addf13e542cab5c31d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit11c41393b7bc63addf13e542cab5c31d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
