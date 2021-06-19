<?php
ini_set('display_errors', "On");
require_once('Database/db.php');

// $page = $_GET["page"];
$db = new Db();
$dbh = $db->dbConnect();
$_get_page = $_GET["page"];
// todo_itemテーブルのidカラムから昇順に10件取得
$ssql = "SELECT * FROM todo_item LIMIT 10, 10 ORDER BY id";
$ssth = $dbh->prepare($ssql);
// $ssth->bindValue(":start", $_get_page * 10);
$ssth->execute();
$data = $ssth->fetchAll(PDO::FETCH_ASSOC);

// 総件数取得
$csql = "SELECT COUNT(*) FROM todo_item";
$ssth = $dbh->prepare($csql);
$ssth->execute();
$item_count = $ssth->fetchAll(PDO::FETCH_ASSOC);

echo('<pre>');
var_dump($data);
echo('</pre>');
echo('<pre>');
var_dump($item_count);
echo('</pre>');
// 総ページ数算出
foreach ($item_count as $count) {
    $total_pages = ceil($count["COUNT(*)"] / 10);
// 現在ページ算出
    if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $total_pages) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
}
var_dump($page);
var_dump($total_pages);

?>
<html>
<body>
<ul>
<?php
foreach($data as $row) {
    echo "<ul>";
    echo "<li>";
    // echo $row["todo_item"]   ;
    echo "<li>";
    echo "</ul>";
}
?>
</ul>
<p>現在 <?php echo $page; ?> ページ</p>
    <p>
        <?php if ($page > 1) : ?>
            <a href="?page=<?php echo ($page - 1); ?>">前へ</a>
        <?php endif; ?>
        <?php if ($page < $total_pages) : ?>
            <a href="?page=<?php echo ($page + 1); ?>">次へ</a>
        <?php endif; ?>
    </p>
</body>
</html>
