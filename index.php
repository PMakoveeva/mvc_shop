<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы

define('ROOT', dirname(__FILE__));
//var_dump(ROOT);

require_once(ROOT . '/components/Router.php');
require_once(ROOT.'/components/Db.php');
//Установка соединения с БД

//Вызов роутер

$router = new Router();
$router->run();