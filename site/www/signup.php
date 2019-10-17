<?php 
require "db.php"; // подключаем файл базы данных
include('header.html');

$data = $_POST; 

if( isset($data['do_signup']))
{
    //Здесь регистрация
    $errors = array(); // Массив ошибок, далее идут всевозможные проверки правильности ввода.
    if(trim($data['login']) == '')
    {
        $errors[] = 'Введите логин!';
    }
    
    if($data['password'] == '')
    {
        $errors[] = 'Введите пароль!';
    }
    
    if(strlen($data['password']) <= 4)
    {
        $errors[] = 'Пароль должен быть 5 или больше символов ';
    }
    
    if($data['rePassword'] != $data['password'])
    {
        $errors[] = 'Пароль не совпадает!';
    }
     if($_POST['check'] != $_POST['random1'])
    {
		print_r($_POST);
		echo "<br>" . $_POST['check'] . " = " . $_POST['random1'];
        $errors[] = "Капча неверна !";
    }
    
    if(trim($data['email']) == '')
    {
        $errors[] = 'Введите email!';
    }
    
    if(trim($data['name']) == '')
    {
        $errors[] = 'Введите имя!';
    }
    
    if(R::count('users',"login = ?", array($data['login'])) > 0)
    {
        $errors[] = 'Пользователь с таким логином уже существует';
    }
    
    if(R::count('users',"email = ?", array($data['email'])) > 0)
    {
        $errors[] = 'На эту почту уже зарегистрирован пользователь';
    }
    // Конец проверок
    
    //Если ошибок нет.
    if( empty($errors))
    {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
        R::store($user);
        echo '<div align="center" style="color: green;">Вы зарегистрировались</div><hr>';
    }
    //Если ошибки есть - выводим их.
    else
    {
        echo '<div align="center" style="color: red;">'.array_shift($errors).'</div><hr>';
        
        
    }
    
}
?>


<!--//Создаём форму регистрации.-->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="row">
                    <form role="form" action="/signup.php" method = "POST">

                        <div class="form-group">
                            <input type="text" name="login" value="<?php echo @$data['login']; ?>" class="form-control input-lg" placeholder="Ваш логин">
                        </div>


                        <div class="form-group">
                            <input type="password" name="password" class="form-control input-lg" placeholder="Ваш пароль">
                        </div>

                        <div class="form-group">
                            <input type="password" name="rePassword" class="form-control input-lg" placeholder="Повторите пароль">
                        </div>

                        <div class="form-group">
                            <input type="email" name="email"  value="<?php echo @$data['email']; ?>" class="form-control input-lg" placeholder="Введите ваш E-mail">
                        </div>

                        <div class="form-group">
                            <input type="text" name="name"  value="<?php echo @$data['name']; ?>" class="form-control input-lg" placeholder="Введите ваше имя">
                        </div>
                        
                        <!--//Ниже реализация капчи.-->
                        
                        <div class="form-group">
                            <input type="hidden" name="random1"  value="<?php echo $captcha1 = rand(1000,9999);?>">
                        </div>
                        
                        <p><?php echo $captcha1 ;?></p>
                        
                        
                           <div class="form-group">
                            <input type="text" name="check" class="form-control input-lg" placeholder="Введите капчу">
                        </div>
                        
                        
                        <!--//Конец реализации капчи.-->
                        
                        <button type="submit" name="do_signup" class="btn btn-primary pull-right">Зарегистрироваться</button>
                        
                    </form>
                </div>

            </div>


        </div>
    </div>
    

    <div class="clear"></div>





</div>

<?php include('footer.html')?>