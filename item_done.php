<?php
ini_set('display_errors', "On");
require_once('Database/db.php');

session_start();

if (isset($_GET)) {
  $id = $_GET['id'];
}

$db = new Db();
$db->doneItems($id);
header('Location:index.php');
