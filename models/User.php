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


}