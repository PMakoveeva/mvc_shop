<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 03.07.2018
 * Time: 20:57
 */

class Product{

    const SHOW_BY_DEFAULT = 10;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT){

        $count = intval($count);
        $db = Db::getConnection();
        $productList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product WHERE status = "1" ORDER BY id DESC LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;

    }

    public static function getProductsListByCategory($categoryId = false){

        if($categoryId) {

            $db = Db::getConnection();
            $productList = array();

            $result = $db->query('SELECT `id`, `name`, `price`, `image`, `is_new` FROM `product` WHERE `status` = "1" and `category_id` =' . $categoryId . 'ORDER BY `id` DESC');
            $i = 0;
            while ($row = $result->fetch()) {
                $productList[$i]['id'] = $row['id'];
                $productList[$i]['name'] = $row['name'];
                $productList[$i]['image'] = $row['image'];
                $productList[$i]['price'] = $row['price'];
                $productList[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $productList;
        }

    }
}