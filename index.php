<?php
ini_set('display_errors', "On");
// セッション開始
session_start();
require_once('Database/db.php');
$db = new Db();
$items = $db->getItems((int)$_SESSION['id']);

// ページング
$totalPage = 10;
if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $totalPage) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}
var_dump($page);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/view.css">
    <title>トップページ</title>
</head>
<body>
<div class="container">
    <div class="login_user_name">
        <?php
        if (isset($_SESSION['login_user_name'])) {
            echo "ようこそ" . $_SESSION['login_user_name'] . "さん  ";
            echo "<a href="."Views/Auth/logout.php".">ログアウト</a>";
        } else {
            header('Location:Views/Auth/login.php');
        }
        ?>
    </div>
    <form action="add.php" method="post">
        <!-- エラーメッセージ -->
        <div class=err_msg>
            <?php
                if (isset($_SESSION['err']['todo_item'])) {
                    echo $_SESSION['err']['todo_item'];
                    unset($_SESSION['err']['todo_item']);
                }
            ?>
        </div>
        <div class=info_msg>
            <?php
                if (isset($_SESSION['delete_msg'])) {
                    echo $_SESSION['delete_msg'];
                    unset($_SESSION['delete_msg']);
                }
            ?>
        </div>
        <div class="item">
            <input type="text" name="todo_item">
        </div>
        <div class="item">
            <input type="submit" value="追加する">
        </div>
    </form>
    <h1>ITEMS</h1>
    <ul class="todo_items">
        <?php foreach($items as $item): ?>
            <li>
                <?php $css = $item['flag'] == 2 ? "yokosen" : ""; ?>
                <span class="<?= $css ?>"><?php echo $item['todo_item']; ?></span>
                <a href="item_done.php?id=<?php echo $item['id']; ?>">DONE</a>
                <a href="item_delete.php?id=<?php echo $item['id']; ?>">DELETE</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>
