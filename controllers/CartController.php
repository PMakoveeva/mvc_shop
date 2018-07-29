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

    public static function actionIndex(){

        $categories = [];
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        $productsInCart = Cart::getProducts();

        if($productsInCart){
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once (ROOT . '/views/cart/index.php');
        return true;

    }
}