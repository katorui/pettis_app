<?php
ini_set('display_errors', "On");
// セッション開始
session_start();
require_once('Database/db.php');
require_once('validation.php');

$todo_item = $_POST['todo_item'];
$user_id = (int)$_SESSION['id'];
// バリデーション
toto_item_check($todo_item);

if (isset($_SESSION['err']['todo_item'])) {
    header('Location:index.php');
} else {
    $db = new Db();
    $db->todoItemAdd($todo_item, $user_id);
    header('Location:index.php');
}
