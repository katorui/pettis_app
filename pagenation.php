<?php
ini_set('display_errors', "On");
require_once('Database/db.php');

$totalPage = 10;

if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $totalPage) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}

$db = new Db();
$db->getItems($page);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
</head>
<body>
    <p>現在 <?php echo $page; ?> ページ</p>
    <p>
        <?php if ($page > 1) : ?>
            <a href="?page=<?php echo ($page - 1); ?>">前へ</a>
        <?php endif; ?>
        <?php if ($page < $totalPage) : ?>
            <a href="?page=<?php echo ($page + 1); ?>">次へ</a>
        <?php endif; ?>
    </p>
</body>
</html>
