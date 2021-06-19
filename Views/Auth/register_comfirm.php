<?php
ini_set('display_errors', "On");
session_start();
require_once('../../validation.php');
require_once('../../function.php');
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
<link rel="stylesheet" href="../../Css/auth.css">
<div class="container">
    <h1 class='title'>
        登録内容確認
    </h1>
    <form action="register_complete.php" method="post">
        <div class="item">
            <label>ユーザー名：<?php echo $name; ?><label>
            <input type="hidden" name="name" value="<?php echo $name; ?>">
        </div>

        <div class="item">
            <label>メールアドレス：<?php echo $mail; ?><label>
            <input type="hidden" name="mail" value="<?php echo $mail; ?>">
        </div>

        <div class="item">
            <label>パスワード：<?php echo $password; ?><label>
            <input type="hidden" name="password" value="<?php echo $password; ?>">
        </div>

        <div class="item">
            <input type="hidden" name="token" value="<?php echo $token ?>">
        </div>

        <p>こちらの内容で登録しますか？</p>
        <div class="item">
            <input type="submit" value="登録する">
        </div>

    </form>
</div>
