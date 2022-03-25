<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit874fb80c86e6c73bb828fe6b8bb1894b
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
            'Aelion\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Aelion\\' => 
        array (
            0 => __DIR__ . '/../..' . '/kernel',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit874fb80c86e6c73bb828fe6b8bb1894b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit874fb80c86e6c73bb828fe6b8bb1894b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit874fb80c86e6c73bb828fe6b8bb1894b::$classMap;

        }, null, ClassLoader::class);
    }
}
