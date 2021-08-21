<?php
ini_set('display_errors', "On");
session_start();
require_once('Database/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new Db();
    $db->item_detail($id);
    $detail = $db->item_detail($id);
    // var_dump($detail[0]["id"]);
    // var_dump($detail[0]["todo_item"]);
}

?>
<link rel="stylesheet" href="Css/view.css">
<div class="container">
<h1>ITEMDETAIL</h1>
    <div class=detail_id>
        <?=$detail[0]["id"] ?>
    </div>
    <div class=detail_todo_item>
        <?=$detail[0]["todo_item"] ?>
    </div>
</div>
