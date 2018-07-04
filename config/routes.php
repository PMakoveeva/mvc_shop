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

    '' => 'site/index', //actionIndex в SiteController

];