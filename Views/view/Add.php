<?php
ini_set('display_errors', "On");
// require_once(dirname( __DIR__) . '/Conponents/sidebar.php');
// require_once('../../Conponents/header.php');
// echo  __DIR__;
// セッション開始
session_start();
// ファイル読み込み
// require_once('../../Database/db.php');
require_once('../../function.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="../../Css/view.css">
<body>
    <div class="container">
        <h1>ADDITEM</h1>
        <form action="../../add.php" method="post">
            <!-- エラーメッセージ -->
            <div class=err_msg>
                <?php
                    if (isset($_SESSION['err']['todo_item'])) {
                        echo $_SESSION['err']['todo_item'];
                        unset($_SESSION['err']['todo_item']);
                    }
                ?>
            </div>
            <div class="item">
                <input type="text" name="todo_item">
            </div>
            <div class="csrf_token">
                <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            </div>
            <div class="button">
                <input class="btn btn-primary" type="submit" value="追加する">
            </div>
        </form>
    </div>
</body>
