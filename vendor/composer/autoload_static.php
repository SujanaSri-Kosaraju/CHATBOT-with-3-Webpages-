<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a9aea3ee97108692307f80ef1838fb5
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
            'Spatie\\PdfToText\\' => 17,
        ),
        'O' => 
        array (
            'Orhanerday\\OpenAi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Spatie\\PdfToText\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/pdf-to-text/src',
        ),
        'Orhanerday\\OpenAi\\' => 
        array (
            0 => __DIR__ . '/..' . '/orhanerday/open-ai/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a9aea3ee97108692307f80ef1838fb5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a9aea3ee97108692307f80ef1838fb5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8a9aea3ee97108692307f80ef1838fb5::$classMap;

        }, null, ClassLoader::class);
    }
}
