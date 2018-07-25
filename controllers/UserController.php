<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.07.2018
 * Time: 1:53
 */

class UserController{

    public function actionRegister(){
        $name = '';
        $email = '';
        $password = '';

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $errors = false;

            if(!User::checkName($name)){
                $errors[] = 'Имя должно быть не короче 2 символов';
            }
            if(!User::checkPassword($password)){
                $errors[] = 'Пороль должен быть длинной минимум 6 символов';
            }
            if(!User::checkEmail($email)){
                $errors[] = 'Неверный email';
            }
            if(User::cheсkEmailExists($email)){
                $errors[] = 'Такой email уже существует';
            }

            if($errors == false){
                $result = User::register($name, $email, $password);
            }

        }


        require_once (ROOT . '/views/user/register.php');

        return true;
    }

    public static function actionLogin(){
        $email = '';
        $password = '';

        if(isset($_POST['submit'])){

            $password = $_POST['password'];
            $email = $_POST['email'];

            $errors = false;

            if(!User::checkPassword($password)){
                $errors[] = 'Пороль должен быть длинной минимум 6 символов';
            }
            if(!User::checkEmail($email)){
                $errors[] = 'Неверный email';
            }


            $userId = User::checkUserData($email, $password);

            if($userId == false){
                $errors[] = 'Неправильные данные для входа';
            }
            else{
                User::auth($userId);

                header("Location: /cabinet/");
            }

        }


        require_once (ROOT . '/views/user/login.php');

        return true;
    }
    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        session_start();
        unset($_SESSION["user"]);
        header("Location: /");
    }


}