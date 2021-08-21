<?php
ini_set('display_errors', "On");
session_start();

?>
<!-- cssファイル読み込み -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
            <label for="exampleFormControlInput1" class="form-label">USERNAME：<label>
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
            <label for="exampleFormControlInput1" class="form-label">EMAIL：<label>
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
            <label for="exampleFormControlInput1" class="form-label">PASSWORD：<label>
            <input type="password" name="password" placeholder="PASSWORD" value="<?php if(isset($_SESSION['input_password'])) { echo $_SESSION['input_password'];
            unset($_SESSION['input_password']); }?>">
        </div>
        <div class="button">
            <input class="btn btn-primary" type="submit" value="TO CONFIRMATION">
        </div>
    </form>
    <p>すでに登録済みの方は<a href="login.php">こちら</a></p>
<div>
