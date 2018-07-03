<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 03.07.2018
 * Time: 0:30
 */
class Db{

    public static function getConnection(){
        $paramPath = ROOT . '/config/db_params.php';

        $params = include_once($paramPath);
        //var_dump($params);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec("set names utf8");

        return $db;

    }

}