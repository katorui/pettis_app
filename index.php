<?php
// ファイル読み込み
// require_once('Conponents/sidebar.php');
require_once( __DIR__ . '/Conponents/header.php');
require_once( __DIR__ . '/function.php');
require_once( __DIR__ . '/Database/db.php');
$db = new Db();
echo dirname(__DIR__);
echo "<br>";
// echo dirname(__FILE__);
// echo "<br>";
echo __DIR__;
// echo "<br>";
// echo __FILE__;
// if (isset($test)) {
//     echo $test;
// }
// $getItems = $db->getItems((int)$_SESSION['id']);
if (isset($_SESSION['id'])) {
    $user_id = ((int)$_SESSION['id']);
}
// ページネーション
$page = (isset($_GET['page']) && 0 < $_GET['page']) ? $_GET['page'] : 1;
$offset_page = 0 < $page ? $page - 1 : 0;
$item_length = 3;
$getPage = $db->getPage($user_id,$offset_page,$item_length);
$item_count = $db->itemCount($user_id);
$total_pages = (int)ceil($item_count[0]["COUNT(*)"] / $item_length);
?>
<link rel="stylesheet" href="Css/view.css">
<title>トップページ</title>
<body>
    <div class="container">
        <h1>ITEMLIST</h1>
        <div class=info_msg>
            <?php
                if (isset($_SESSION['delete_msg'])) {
                    echo $_SESSION['delete_msg'];
                    unset($_SESSION['delete_msg']);
                }
            ?>
        </div>
        <ul class="todo_items">
            <?php foreach($getPage as $item): ?>
                <!-- <?php var_dump($item); ?> -->
                <li>
                    <?php $css = $item['flag'] == 2 ? "line" : ""; ?>
                    <span class="<?= $css ?>"><?php echo $item['todo_item']; ?></span>
                    <a href="item_done.php?id= $item['id'];">DONE</a>
                    <a href="item_delete.php?id=<?php echo $item['id']; ?>">DELETE</a>
                    <a href="item_detail.php?id=<?php echo $item['id']; ?>">DETAIL</a>
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
