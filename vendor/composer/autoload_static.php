<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit501ceeb5b9a40a1f0f69599b224211f8
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'core\\' => 5,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'app\\controllers\\AppController' => __DIR__ . '/../..' . '/app/controllers/AppController.php',
        'app\\controllers\\ReportController' => __DIR__ . '/../..' . '/app/controllers/ReportController.php',
        'app\\controllers\\TrackerController' => __DIR__ . '/../..' . '/app/controllers/TrackerController.php',
        'app\\models\\AppModel' => __DIR__ . '/../..' . '/app/models/AppModel.php',
        'app\\models\\ReportModel' => __DIR__ . '/../..' . '/app/models/ReportModel.php',
        'core\\Controller' => __DIR__ . '/../..' . '/core/Controller.php',
        'core\\Model' => __DIR__ . '/../..' . '/core/Model.php',
        'core\\Router' => __DIR__ . '/../..' . '/core/Router.php',
        'core\\View' => __DIR__ . '/../..' . '/core/View.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit501ceeb5b9a40a1f0f69599b224211f8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit501ceeb5b9a40a1f0f69599b224211f8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit501ceeb5b9a40a1f0f69599b224211f8::$classMap;

        }, null, ClassLoader::class);
    }
}
