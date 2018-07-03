<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 02.07.2018
 * Time: 14:33
 */

class ProductController{

    public function actionView($id){

        require_once(ROOT . '/views/product/view.php');
        return true;
    }

}