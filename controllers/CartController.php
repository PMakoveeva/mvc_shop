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

    public static function actionCheckout(){

        $categories = [];
        $categories = Category::getCategoriesList();

        $result = false;

        if(isset($_POST['submit'])){

            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];


            $errors = false;

            if(!User::checkName($userName)){
                $errors[] = 'Неверное имя';
            }
            if(User::checkPhone($userPhone)){
                $errors[] = 'Неправильный номер телефона';
            }

            if($errors == false){

                $productsInCart = Cart::getProducts();
                if(User::isGuest()){
                    $userId = false;
                }
                else{
                    $userId = User::checkLogged();
                }

                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
//                    // Оповещаем администратора о новом заказе
//                    $adminEmail = 'php.start@mail.ru';
//                    $message = 'http://digital-mafia.net/admin/orders';
//                    $subject = 'Новый заказ!';
//                    mail($adminEmail, $subject, $message);

                    // Очищаем корзину
                    Cart::clear();
                }
            } else {
                // Форма заполнена корректно? - Нет
                // Итоги: общая стоимость, количество товаров
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
        } else {
            // Форма отправлена? - Нет
            // Получием данные из корзины
            $productsInCart = Cart::getProducts();

            // В корзине есть товары?
            if ($productsInCart == false) {
                // В корзине есть товары? - Нет
                // Отправляем пользователя на главную искать товары
                header("Location: /");
            } else {
                // В корзине есть товары? - Да
                // Итоги: общая стоимость, количество товаров
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();


                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Пользователь авторизирован?
                if (User::isGuest()) {
                    // Нет
                    // Значения для формы пустые
                } else {
                    // Да, авторизирован
                    // Получаем информацию о пользователе из БД по id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    // Подставляем в форму
                    $userName = $user['name'];
                }
            }
        }

        require_once(ROOT . '/views/cart/checkout.php');

        return true;

    }

    public static function actionDelete($deleteId){
        Cart::deleteProducts($deleteId);
        header("Location:/cart/");
    }
}