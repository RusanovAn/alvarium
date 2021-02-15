<?php

/**Файл формує глобальні константи
 * та підключає автозавантажувач Composer
 */

define('ROOT', dirname(__DIR__));
define('LAYOUT', 'admin');
define('COUNTONPAGE', [
                        'default' => 10,
                        'counts' => [10, 25, 50, 100]
                        ]
);
require_once ROOT . '/vendor/autoload.php';
