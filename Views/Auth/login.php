<?php
ini_set('display_errors', "On");
session_start();

?>

<link rel="stylesheet" href="../../Css/auth.css">
<div class="container">
    <h1 class="item">
        LOGIN
    </h1>
    <form action="login_complete.php" method="post">
        <!-- フォーム入力のエラーメッセージがあれば表示、db検索エラーメッセージがあれば表示 -->
        <div class="err_msg">
            <?php
                if (isset($_SESSION['err']['email'])) {
                    echo $_SESSION['err']['email'];
                    unset($_SESSION['err']['email']);
                } elseif (isset($_SESSION['err']['db_err'])) {
                    echo $_SESSION['err']['db_err'];
                    unset($_SESSION['err']['db_err']);
                }
            ?>
        </div>
        <div class="item">
            <label>EMAIL：<label>
            <!-- value値に確認画面の値を設定 -->
            <input type="text" name="email" placeholder="EMAIL" required value="<?php if (isset($_SESSION['input_login_email']
                )) {
                echo $_SESSION['input_login_email'];
                unset($_SESSION['input_login_email']);} ?>">
        </div>
<!-- エラーメッセージ -->
        <div class="err_msg">
            <?php
                if (isset($_SESSION['err']['password'])) {
                    echo $_SESSION['err']['password'];
                    unset($_SESSION['err']['password']);
                } elseif (isset($_SESSION['err']['db_err'])) {
                    echo $_SESSION['err']['db_err'];
                    unset($_SESSION['err']['db_err']);
                }
            ?>
        </div>
        <div class="item">
            <label>PASSWORD：<label>
            <input type="password" name="password" placeholder="PASSWORD" required>
        </div>
        <div class="item">
            <input type="submit" value="ログイン">
        </div>
    </form>
    <p>まだ登録がお済みでない方<a href="register.php">こちら</a></p>
</div>
