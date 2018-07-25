<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.07.2018
 * Time: 18:10
 */
class CabinetController{

    public function actionIndex(){

        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        echo  $user['name'];
        require_once (ROOT . '/views/cabinet/index.php');

        return true;

    }

    public function actionEdit(){
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $result = '';
        $name = $user['name'];
        $password = $user['password'];


        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $password = $_POST['password'];


            $errors = false;

            if(!User::checkName($name)){
                $errors[] = 'Имя должно быть не короче 2 символов';
            }
            if(!User::checkPassword($password)){
                $errors[] = 'Пороль должен быть длинной минимум 6 символов';
            }


            if($errors == false){
                $result = User::edit($userId, $name, $password);
            }

        }


        require_once (ROOT . '/views/cabinet/edit.php');

        return true;
    }

}