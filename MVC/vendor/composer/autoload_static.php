<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb7da39ef004a46aacfbb9ce31ecfe6ff
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MVC\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb7da39ef004a46aacfbb9ce31ecfe6ff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb7da39ef004a46aacfbb9ce31ecfe6ff::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb7da39ef004a46aacfbb9ce31ecfe6ff::$classMap;

        }, null, ClassLoader::class);
    }
}
