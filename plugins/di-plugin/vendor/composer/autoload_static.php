<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf56f546a831cf7d8aa2a2bdac8a4ca7b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Plugin\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Plugin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf56f546a831cf7d8aa2a2bdac8a4ca7b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf56f546a831cf7d8aa2a2bdac8a4ca7b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf56f546a831cf7d8aa2a2bdac8a4ca7b::$classMap;

        }, null, ClassLoader::class);
    }
}
