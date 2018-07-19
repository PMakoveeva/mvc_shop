<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы

define('ROOT', dirname(__FILE__));
//var_dump(ROOT);

//Установка соединения с БД
require_once (ROOT . '/components/Autoload.php');
//require_once(ROOT . '/components/Router.php');
//require_once(ROOT.'/components/Db.php');


//Вызов роутер

$router = new Router();
$router->run();