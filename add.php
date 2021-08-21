<?php
ini_set('display_errors', "On");
// セッション開始
session_start();
require_once('Database/db.php');
require_once('Moduls/validation.php');
// require_once('function.php');

var_dump($_POST);
var_dump($_SESSION['csrf_token']);

if (isset($_POST['csrf_token'])) {
    $token =  $_POST['csrf_token'];
};
// ワンタイムトークン
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエストです');
}
unset($_SESSION['csrf_token']);

if (isset($_POST['todo_item'])) {
    $todo_item = $_POST['todo_item'];
}
$user_id = (int)$_SESSION['id'];
// バリデーション
toto_item_check($todo_item);

if (isset($_SESSION['err']['todo_item'])) {
    header('Location:Views/view/Add.php');
} else {
    $db = new Db();
    $db->todoItemAdd($todo_item, $user_id);
    header('Location:index.php');
}
