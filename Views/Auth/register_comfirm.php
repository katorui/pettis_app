<?php
ini_set('display_errors', "On");
session_start();
require_once( dirname(__DIR__) . '/../Moduls/validation.php');
require_once( dirname(__DIR__) . '/../function.php');
// $name = $_POST['name'];
$name = isset($_POST["name"]) ? shape($_POST["name"]) : "";
$mail = $_POST['mail'];
$password = $_POST['password'];

register_name_check($name);
email_check($mail);
password_check($password);

// エラーがあれば前ページへリダイレクト
if (isset($_SESSION['err']['register_name']) || isset($_SESSION['err']['email']) || isset($_SESSION['err']['password'])) {
    $_SESSION['input_name'] = $name;
    $_SESSION['input_email'] = $mail;
    $_SESSION['input_password'] = $password;
    header('Location:register.php');
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="../../Css/auth.css">
<div class="container">
    <h1 class='title'>
        <!-- REGISTERCOMFIRM -->
    </h1>
    <form action="register_complete.php" method="post">
        <div class="item">
            <label >USERNAME：<?php echo $name; ?><label>
            <input type="hidden"  name="name" value="<?php echo $name; ?>">
        </div>

        <div class="item">
            <label>EMAIL：<?php echo $mail; ?><label>
            <input type="hidden" name="mail" value="<?php echo $mail; ?>">
        </div>

        <div class="item">
            <label>PASSWORD：<?php echo $password; ?><label>
            <input type="hidden" name="password" value="<?php echo $password; ?>">
        </div>

        <div class="item">
            <input type="hidden" name="token" value="<?php echo $token ?>">
        </div>

        <p>こちらの内容で登録しますか？</p>
        <div class="button">
            <input class="btn btn-primary" type="submit" value="REGISTER">
        </div>

    </form>
</div>
