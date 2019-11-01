<?php
include('header.html');


require_once ('logintouser.php');
$conn = new mysqli($hm, $un, $pw, $db);
if ($conn->connect_error) die("Ошибка при подключении");

$email = $_POST['nane_email'];

//$query = "SELECT * FROM models";
$query = "SELECT login FROM users WHERE email ='$email'";
$result = $conn->query($query);



if(isset($_POST['nane_email'])){
    print_r($_POST);
    $rows = $result->num_rows;
    echo $rows;
    $password= $_POST['password'];
    $query = "Update users set password = '$password' Where email ='$email'";
    $result = $conn->query($query);
}





?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="row">
                <form role="form" action="/fogotPassword.php" method = "POST">

                        <div class="form-group">
                            <input type="text" name="nane_email" class="form-control input-lg" placeholder="Ваш логин">
                        </div>

                        <div class="form-group">
                            <input type="text" name="password" class="form-control input-lg" placeholder="Введите пароль">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" name="repassword" class="form-control input-lg" placeholder="Повторите пароль">
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