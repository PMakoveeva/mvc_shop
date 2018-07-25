<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.07.2018
 * Time: 2:01
 */
class User{
    public static function register($name, $email, $password){
        $db = Db::getConnection();

        $sql = 'INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();

    }

    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public  static  function cheсkEmailExists($email){
       $db = Db::getConnection();

//        $result = $db->query('SELECT COUNT(*) FROM users WHERE email ='. $email);
//
//
//        if($result == false){
//            return false;
//        }
//        else{
//            return true;
//        }
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn()){
            return true;
        }
        return false;
    }

    public static function checkUserData($email, $password){
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);

        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        $result->execute();
        //var_dump($result->fetch());

        $user = $result->fetch();

        if($user){
            return $user['id'];
        }
        return false;

    }


    public static function auth($userId){

        $_SESSION['user'] = $userId;
    }

    public  static function  checkLogged(){

        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        else{
            header("location: /user/login");
        }

    }

    public static function isGuest(){

        if(isset($_SESSION['user'])){
            return false;
        }
        else{
            return true;
        }
    }

    public static function getUserById($id){
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE id = :id';

        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_STR);

        $result->execute();
        //var_dump($result->fetch());

        $user = $result->fetch();

        if($user){
            return $user;
        }
        return false;
    }

    public static function edit($id, $name, $password){
        $db = Db::getConnection();

        $sql = 'UPDATE users SET name = :name, password = :password WHERE id = :id';

        $result = $db->prepare($sql);

        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }


}