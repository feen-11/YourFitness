<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit401fec02ddcd23d77509dcf2a2a81c0d
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit401fec02ddcd23d77509dcf2a2a81c0d::$classMap;

        }, null, ClassLoader::class);
    }
}
