<?php
ini_set('display_errors', "On");
require_once('../../Database/db.php');
// var_dump($_POST);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
};
if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
};
if (isset($_POST['password'])) {
    $password = $_POST['password'];
};

// trycatch
$db = new Db();
$db->userRegisterAdd($name,$mail,$password);
    header('Location:../../index.php');
