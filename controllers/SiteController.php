<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 30.06.2018
 * Time: 2:10
// */
//include_once  ROOT . '/models/Category.php';
//include_once  ROOT . '/models/Product.php';

class SiteController{

    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(6);

        require_once(ROOT . '/views/site/index.php');

        return true;
    }
}