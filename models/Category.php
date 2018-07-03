<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 03.07.2018
 * Time: 0:29
 */


class Category{

    public static function getCategoriesList()
    {

        $db = Db::getConnection();

        $categoryList = array();

        $result = $db->query('SELECT id, name FROM category '
            . 'ORDER BY sort_order ASC');

        $i = 0;
//        var_dump($result);
//        exit();

        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;
    }
}