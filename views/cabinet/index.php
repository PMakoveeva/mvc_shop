<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.07.2018
 * Time: 18:12
 */
include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <h1>Кабинет пользователя</h1>
                <h2>Привет,  <?php echo $user['name']?>!</h2>

                <ul>
                    <li><a href="/cabinet/edit">Редактировать данные</a></li>
                    <li><a href="/user/history">Список покупок</a></li>
                </ul>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>