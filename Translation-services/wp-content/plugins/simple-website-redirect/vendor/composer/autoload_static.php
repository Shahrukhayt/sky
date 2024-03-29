<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfb888aabe0328075100872d8dd1c4a6d
{
    public static $prefixLengthsPsr4 = array (
        'w' => 
        array (
            'wpscholar\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'wpscholar\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpscholar/url',
        ),
    );

    public static $classMap = array (
        'wpscholar\\Url' => __DIR__ . '/..' . '/wpscholar/url/Url.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfb888aabe0328075100872d8dd1c4a6d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfb888aabe0328075100872d8dd1c4a6d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfb888aabe0328075100872d8dd1c4a6d::$classMap;

        }, null, ClassLoader::class);
    }
}
