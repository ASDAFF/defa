<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit59bc989a1289eb9f82b7c1aa208ad208
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Defo\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Defo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Defo',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit59bc989a1289eb9f82b7c1aa208ad208::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit59bc989a1289eb9f82b7c1aa208ad208::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
