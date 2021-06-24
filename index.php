<?php
ini_set('display_errors', "On");
// セッション開始
session_start();
// ファイル読み込み
require_once('Database/db.php');
// require_once('pagenation.php');
$db = new Db();
$getitems = $db->getItems((int)$_SESSION['id']);
echo "<pre>";
// var_dump($items);
echo "</pre>";

// ページネーション
$page = (isset($_GET['page']) && 0 < $_GET['page']) ? $_GET['page'] : 1;
$offset_page = 0 < $page ? $page - 1 : 0;
$item_length = 3;
$getPage = $db->getPage($offset_page,$item_length);
$item_count = $db->itemCount();
$total_pages = (int)ceil($item_count[0]["COUNT(*)"] / $item_length);

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
        <?php foreach($getitems as $item): ?>
            <li>
                <?php $css = $item['flag'] == 2 ? "line" : ""; ?>
                <span class="<?= $css ?>"><?php echo $item['todo_item']; ?></span>
                <a href="item_done.php?id=<?php echo $item['id']; ?>">DONE</a>
                <a href="item_delete.php?id=<?php echo $item['id']; ?>">DELETE</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- ページリンク -->
    <div class="page_link">
        <p>
            <?php if ($page > 1) : ?>
                <a href="?page=1">最初</a>
                <?php if ($page > 3) :?>
                    <a href="?page=<?php echo ($page - 2); ?>"><?php echo ($page - 2); ?></a>
                <?php endif; ?>
                <?php if ($page > 2) :?>
                    <a href="?page=<?php echo ($page - 1); ?>"><?php echo ($page - 1); ?></a>
                <?php endif; ?>
                <!-- <a href="?page=<?php echo ($page - 1); ?>">前へ</a> -->
            <?php endif; ?>
            <span><?php echo $page; ?></span>
            <?php if ($page < $total_pages) : ?>
                <!-- <a href="?page=<?php echo ($page + 1); ?>">次へ</a> -->
                <?php if ($page < $total_pages - 1) :?>
                    <a href="?page=<?php echo ($page + 1); ?>"><?php echo ($page + 1); ?></a>
                <?php endif; ?>
                <?php if ($page <  $total_pages - 2) :?>
                    <a href="?page=<?php echo ($page + 2); ?>"><?php echo ($page + 2); ?></a>
                <?php endif; ?>
                <a href="?page=<?php echo $total_pages; ?>">最後</a>
            <?php endif; ?>
        </p>
    </div>
</div>
</body>
</html>
