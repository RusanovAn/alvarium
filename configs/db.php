<?php

/**
 * Массив з параметрами підключення до Бази данних
 */

return[
    'driver' => 'mysql',
    'host' => 'localhost',
    'db' => 'salary_project',
    'user' => 'root',
    'pass' => 'root',
    'opt' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];
