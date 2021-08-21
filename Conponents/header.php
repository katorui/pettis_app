<?php
session_start();
ini_set('display_errors', "On");
echo dirname(__DIR__);
echo "<br>";
echo __DIR__;
echo "<br>";
echo dirname(__FILE__);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/header.css">
</head>
<body>
    <div  class="header_wrap">
        <div class="login_user_name">
            <?php
                if (isset($_SESSION['login_user_name'])) {
                    echo "ようこそ" . $_SESSION['login_user_name'] . "さん  ";
                    echo "<a href="."Views/Auth/logout.php".">ログアウト</a>";
                } else {
                    // header('Location:Views/Auth/login.php');
                }
            ?>
        </div>
    </div>
</body>
