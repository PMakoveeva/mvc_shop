<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 02.07.2018
 * Time: 1:43
 */

class Router
{
    private $routes;

    public function __construct(){
        $routesPath = ROOT . '/config/routes.php';
        $this -> routes = include($routesPath);
    }

    private function getURL(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run(){
//        print_r($this->routes);
//        echo 'hello everyone';
        //получить строку запроса
        $uri = $this ->getURL();
        //echo $url;

        //проверить подключение такого запроса в routes.php

        foreach ($this ->routes as $uriPattern => $path){
            //echo "<br>$uriPattern => $path";
            if(preg_match("~$uriPattern~", $uri)) {
//                echo $uri .'<pre>';
//                echo $uriPattern .'<pre>';
//                echo $path .'<pre>';

                //echo $path;

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                //var_dump($internalRoute);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments). 'Controller';

                $controllerName = ucfirst($controllerName);
                //echo $controllerName;
                $actionName = 'action' . ucfirst(array_shift($segments));
                //echo $actionName;
                $parameters = $segments;
                //var_dump($parameters);
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';

//                echo $controllerFile;
//                exit();
                if(file_exists($controllerFile)){
                    //echo 'Hello';
                    include_once ($controllerFile);
                }

                $controllerObject = new $controllerName;
//                print_r ($controllerObject);
                //$result = $controllerObject->$actionName($parameters);
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if($result != null){
                    break;
                }
            }
        }




        //если есть совпаддения то определить какой action и controller обрабатывают этот запрос

        //Подключить файл класса контроллера

        //Создать объект вызвать метод (т. е. action)
    }

}