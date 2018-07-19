<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.07.2018
 * Time: 1:42
 */

function __autoload($class_name){

    $array_paths = ['/models/', '/components/'];

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';

        if(is_file($path)){
            include_once $path;
        }

    }
}