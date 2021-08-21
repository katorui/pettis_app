<?php
// エラー表示
ini_set('display_errors', "On");
// セッション開始
session_start();
// ページ読み込み
require_once('../../Moduls/validation.php');
require_once('../../Database/db.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
};
if (isset($_POST['password'])) {
    $password = $_POST['password'];
};
if (isset($_POST['csrf_token'])) {
    $token =  $_POST['csrf_token'];
};
// ワンタイムトークン
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエストです');
}
unset($_SESSION['csrf_token']);

// バリデーション
email_check($email);
password_check($password);

// エラーがあれば前ページへリダイレクト
if (isset($_SESSION['err']['email']) || isset($_SESSION['err']['password'])) {
    $_SESSION['input_login_email'] = $email;
    $_SESSION['input_login_password'] = $password;
    header('Location:login.php');
}

    // エラーがなければデータベースからユーザー情報取得
    $db = new Db();
    $login_users = $db->userLogin($email);
    // ログイン画面から入力されたパスワードと、データベースに登録してあるパスワードが等しいか調べる
    if (password_verify($password, $login_users['password'])) {
        // 正しければセッションidを新たに発行
        session_regenerate_id(true);
        // echo session_id();
    // ログインユーザー名をセッションで保持しログインのキーとする
        $_SESSION['login_user_name'] = $login_users['user_name'];
        $_SESSION['id'] = $login_users['user_id'];
        // var_dump($_SESSION);
        header('Location:../../index.php');
    } else {
        // 正しくなければエラーメッセージを添えリダイレクト
        $_SESSION['err']['db_err'] = "※パスワードまたはメールアドレスが違います";
        header('Location:login.php');
    }














//     echo $mail;
//     echo $password;

// $db = new Db();
// $login_user = $db->userLogin($mail;
// echo $login_user['email'];
// $login_user = $db->userLogin($mail);
// echo $login_user;
//
// $login_user = $db->userLogin($mail);
// try {
//   $pdo = new PDO(DSN, DB_USER, DB_PASS);
//   $stmt = $pdo->prepare('select * from userDeta where email = ?');
//   $stmt->execute([$_POST['email']]);
//   $row = $stmt->fetch(PDO::FETCH_ASSOC);
// } catch (\Exception $e) {
//   echo $e->getMessage() . PHP_EOL;
// }
// //emailがDB内に存在しているか確認
// if (!isset($row['email'])) {
//   echo 'メールアドレス又はパスワードが間違っています。';
//   return false;
// }
