<?php
/**
 * Created by PhpStorm.
 * User: Полина
 * Date: 20.07.2018
 * Time: 1:55
 */
 include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 padding-right">
                    <?php if($result):?>
                        <p>Вы зарегистрированы!</p>
                    <?php else:?>
                        <?php if(isset($errors) && is_array($errors)): ?>
                            <ul>
                                <?php foreach ($errors as $error):?>
                                    <li> - <?php echo $error?></li>
                                <?php endforeach;?>
                            </ul>
                        <?php endif;?>

                        <div class="signup-form"><!--sign up form-->
                            <h2>Регистрация на сайте</h2>
                            <form action="#" method="post">
                                <input type="text" name="name" placeholder="Имя" value="<?php  echo $name?>"/>
                                <input type="email" name="email" placeholder="E-mail" value="<?php  echo $email?>"/>
                                <input type="password" name="password" placeholder="Пароль" value="<?php  echo $password?>"/>
                                <input type="submit" name="submit" class="btn btn-default" value="Регистрация"/>
                            </form>
                        </div><!--/sign up form-->
                  <?php endif;?>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>