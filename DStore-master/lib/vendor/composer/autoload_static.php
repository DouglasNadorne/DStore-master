<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit825a7b96724b6db9a9b89ec2dbd4366a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit825a7b96724b6db9a9b89ec2dbd4366a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit825a7b96724b6db9a9b89ec2dbd4366a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit825a7b96724b6db9a9b89ec2dbd4366a::$classMap;

        }, null, ClassLoader::class);
    }
}
