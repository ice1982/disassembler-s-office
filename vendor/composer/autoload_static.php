<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitebeef591a51436d2edb8b9671ff21499
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/composer',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitebeef591a51436d2edb8b9671ff21499::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitebeef591a51436d2edb8b9671ff21499::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
