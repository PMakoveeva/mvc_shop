<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 28.07.2018
 * Time: 11:58
 */

class CartController{

    public static function actionAdd($id){
        Cart::addProduct($id);

        $referrer = $_SERVER['HTTP_REFERER'];
        header("location: $referrer");
    }

    public static function actionAddAjax($id){
        echo Cart::addProduct($id);
        return true;
    }
}