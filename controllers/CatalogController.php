<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 04.07.2018
 * Time: 16:14
 */
include_once  ROOT . '/models/Category.php';
include_once  ROOT . '/models/Product.php';

class CatalogController{

    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(4);

        require_once(ROOT . '/views/catalog/index.php');

        return true;
    }

    public function actionCategory($categoryId){

        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId);

        require_once(ROOT . '/views/catalog/category.php');

        return true;

    }

}