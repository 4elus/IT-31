<?php
require "db.php";
include('header.html');

$data = $_POST;

// Если пользователь выполнил logout - завершаем сессию
if( isset($data['do_exit']))
{
    unset($_SESSION['logged_user']);
}


//Если пользователь залогинился 
if( isset($data['do_login']))
{
    $errors = array();
    
    $user= R::findOne('users', 'login=?', array($data['login'])); //Ищем пользователя в базе данных
    
    if($user)
    {
        // Проверка правильности ввода пароля
        if(password_verify($data['password'],$user->password))
        {
            $_SESSION['logged_user'] = $user;
        }
        else
        {
            $errors[] = 'Неверно введён пароль!';
        }
    }
    //Если не нашли такого пользователя
    else
    {
        $errors[] = 'Пользователь с таким логином не найден!';
    }
    
    if( ! empty($errors))
    {
        echo '<div align="center" style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}

?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-lg-push-3">
                <div class="row">
                    <p>Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в
                        формировании позиций, занимаемых участниками в отношении поставленных задач. Не следует, однако забывать, что новая модель организационной
                        деятельности обеспечивает широкому кругу (специалистов) участие в формировании систем массового участия.</p>


                    <p>С другой стороны реализация намеченных плановых заданий обеспечивает широкому кругу (специалистов) участие в формировании позиций,
                        занимаемых участниками в отношении поставленных задач. Повседневная практика показывает, что консультация с широким активом играет
                        важную роль в формировании соответствующий условий активизации. Товарищи! сложившаяся структура организации обеспечивает широкому кругу
                        (специалистов) участие в формировании системы обучения кадров, соответствует насущным потребностям. Разнообразный и богатый опыт
                        новая модель организационной деятельности в значительной степени обуславливает создание форм развития.</p>
                </div>

            </div>
            
            
            
            
            
            
            <!-- #Форма авторизации до входа на сайт. -->
            <?php if(! isset($_SESSION['logged_user'])): echo '<div class="col-lg-3 col-lg-pull-9">
                <div class="panel panel-primary">
                    <div class="panel-heading"><div class="sidebar-header">Вход</div>
                    </div>

                    <div class="panel-body">

                        <form role="form" action="index.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="login" class="form-control input-lg" placeholder="Ваш логин">
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control input-lg" placeholder="Ваш пароль">
                            </div>

                            <button type="submit" name="do_login" class="btn btn-primary pull-right">Вход</button>
                        </form>
                    </div>

                </div>
            </div>'?>
            
            <!-- //Форма авторизации после входа на сайт. -->
            <?php else: echo '<div class="col-lg-3 col-lg-pull-9">
                <div class="panel panel-primary">
                    <div class="panel-heading"><div class="sidebar-header">'?>
            Привет, <?php echo  $_SESSION['logged_user']->login; ?></div>
                    </div><?php echo '

                    <div class="panel-body">

                        <form role="form" action="index.php" method="POST">
                          

                            <button type="submit" name="do_exit" class="btn btn-primary pull-right">Выход</button>
                        </form>
                    </div>

                </div>
                
            </div>' ?>
            <?php endif;?>
            
        </div>
    <!-- //Подчёркивает красным, пока не знаем почему, но всё работает. Если сможете, попробуйте исправить, но, если что, не обращайте внимания. -->
    </div>

    <div class="clear"></div>

    <section class="gallery">
        <h2>Немного фотографий</h2>
        <div id="slider">
            <div><img src="assets/img/16.png" alt=""></div>
            <div><img src="assets/img/4.jpg" alt=""></div>
            <div><img src="assets/img/2.jpeg" alt=""></div>
            <div><img src="assets/img/2.png" alt=""></div>
        </div>
    </section>
<!-- //Подчёркивает красным, пока не знаем почему, но всё работает. Если сможете, попробуйте исправить, но, если что, не обращайте внимания. -->


</div>

<?php
include('footer.html');
?>
