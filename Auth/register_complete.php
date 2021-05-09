<?php
// var_dump($_POST);
$name = $_POST['name'];
$mail = $_POST['mail'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// $password = $_POST['password'];
echo $name;
echo $mail;
echo $password;
