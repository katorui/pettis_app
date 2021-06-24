<?php
ini_set('display_errors', "On");
require_once('Database/db.php');

// 三項演算子
// $_GET['page']に値がセットされていて0より大きければ$pageに$_GET['page']を代入、そうでなければ1を代入
$page = (isset($_GET['page']) && 0 < $_GET['page']) ? $_GET['page'] : 1;
// $pageが0より大きければ$page-1を$offset_pageに代入、そうでなければ0を代入
$offset_page = 0 < $page ? $page - 1 : 0;
$item_length = 3;

$db = new Db();
$dbh = $db->dbConnect();
// todo_itemテーブルのidカラムから昇順に10件取得
$ssql = "SELECT * FROM todo_item ORDER BY id LIMIT :start, " . $item_length;
$ssth = $dbh->prepare($ssql);
$ssth->bindValue(":start", $offset_page * $item_length, PDO::PARAM_INT);
$ssth->execute();
$data = $ssth->fetchAll(PDO::FETCH_ASSOC);
// 総件数取得
$csql = "SELECT COUNT(*) FROM todo_item";
$ssth = $dbh->prepare($csql);
$ssth->execute();
$item_count = $ssth->fetchAll(PDO::FETCH_ASSOC);
// 総ページ数
$total_pages = (int)ceil($item_count[0]["COUNT(*)"] / $item_length);

var_dump($page);
var_dump($total_pages);
?>
<html>
<body>
<ul>
<?php
foreach($data as $todo_item) {
    echo "<li>";
    echo $todo_item["todo_item"];
    echo "</li>";
}
?>
</ul>
<p>現在 <?php echo $page; ?> ページ</p>
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
</body>
</html>
