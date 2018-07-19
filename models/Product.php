<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 03.07.2018
 * Time: 20:57
 */

class Product{

    const SHOW_BY_DEFAULT = 1;

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

    public static function getProductsListByCategory($categoryId = false, $page = 1){
        $page = intval($page);
        if($categoryId && $page) {

            $db = Db::getConnection();
            $productList = array();
            $offset = ($page-1) * self::SHOW_BY_DEFAULT;
            $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id DESC "
                . " LIMIT ".self::SHOW_BY_DEFAULT
                . " OFFSET " . $offset );
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

    public static function getProductById($productId = false){

        if($productId){

            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id ='. $productId);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();

        }

    }
    public static function getTotalProductsInCategory($categoryId){
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];


    }
}