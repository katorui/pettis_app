<?php
ini_set('display_errors', "On");
session_start();
require_once( dirname(__DIR__) . '/../function.php');
echo dirname(__DIR__);
echo "<br>";
$top_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"];
echo $top_url;

// var_dump($_SESSION['csrf_token']);
?>
<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Css/auth.css">
    <title>login</title>
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
                <label for="exampleFormControlInput1" class="form-label">EMAIL：<label>
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
                <label for="exampleFormControlInput1" class="form-label">PASSWORD：<label>
                <input type="password" name="password" placeholder="PASSWORD" required>
            </div>
            <div class="item">
                <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            </div>
            <div class="button">
                <input class="btn btn-primary" type="submit" value="LOGIN">
            </div>
        </form>
        <p>まだ登録がお済みでない方<a href="register.php">こちら</a></p>
    </div>
</body>
