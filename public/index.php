<?php

use core\Router;
/**Фронт контроллер
 * Приймає всі запити від користувача
 * Встановлює глобальні настройки: PHP
 * Перевіряє та стартує сессію
 * підключає файл конфігурацій
 * Викликає контроллер додатку
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('date.timezone', "Europe/Kiev");

session_start();
require '../configs/configs.php';
$url = $_SERVER['REQUEST_URI'];
Router::start($url);