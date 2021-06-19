<?php
ini_set('display_errors', "On");
session_start();
require_once('Database/db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new Db();
    $db->deleteItems($id);
    $_SESSION['delete_msg'] = "アイテムを削除しました";
    header('Location:index.php');
  }
