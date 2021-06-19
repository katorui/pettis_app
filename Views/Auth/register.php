<?php
ini_set('display_errors', "On");
session_start();

?>
<!-- cssファイル読み込み -->
<link rel="stylesheet" href="../../Css/auth.css">
<div class="container">
    <h1 class='title'>
        REGISTER
    </h1>
    <form action="register_comfirm.php" method="post">
        <!-- エラーメッセージがあれば表示-->
        <div class="err_msg">
            <?php
                if (isset($_SESSION['err']['register_name'])) {
                    echo $_SESSION['err']['register_name'];
                    unset($_SESSION['err']['register_name']);
                }?>
        </div>
        <div class="item">
            <label>USERNAME：<label>
            <input type="text" name="name" placeholder="USERNAME" value="<?php if(isset($_SESSION['input_name'])) { echo $_SESSION['input_name'];
            unset($_SESSION['input_name']); }?>">
        </div>
        <!-- エラーメッセージがあれば表示-->
        <div class="err_msg">
            <?php
                if (isset($_SESSION['err']['email'])) {
                    echo $_SESSION['err']['email'];
                    unset($_SESSION['err']['email']);
                }
            ?>
        </div>
        <div class="item">
            <label>EMAIL：<label>
            <input type="text" name="mail" placeholder="EMAIL" value="<?php if(isset($_SESSION['input_email'])) { echo $_SESSION['input_email'];
            unset($_SESSION['input_email']); }?>">
        </div>
        <!-- エラーメッセージがあれば表示-->
        <div class="err_msg">
            <?php
                if (isset($_SESSION['err']['password'])) {
                    echo $_SESSION['err']['password'];
                    unset($_SESSION['err']['password']);
                    }
            ?>
        </div>
        <div class="item">
            <label>PASSWORD：<label>
            <input type="password" name="password" placeholder="PASSWORD" value="<?php if(isset($_SESSION['input_password'])) { echo $_SESSION['input_password'];
            unset($_SESSION['input_password']); }?>">
        </div>
        <div class="item">
            <input type="submit" value="登録確認画面へ">
        </div>
    </form>
    <p>すでに登録済みの方は<a href="login.php">こちら</a></p>
<div>
