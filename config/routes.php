<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 30.06.2018
 * Time: 2:09
 */

return [

    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController

    'catalog' => 'catalog/index',

    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1',

    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController

    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAdd в CartController
    'cart' => 'cart/index',




    'user/register' => 'user/register',  //actionRegister in UserController
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',

    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index', //actionIndex in CabinetController



    '' => 'site/index', //actionIndex в SiteController

];