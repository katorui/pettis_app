<?php
$name = $_POST['name'];
$mail = $_POST['mail'];
$password = $_POST['password'];
// var_dump($_POST);

?>
<h1>登録内容確認</h1>
<form action="register_complete.php" method="post">
    <div>
        <label>名前：<?php echo $name; ?><label>
        <input type="hidden" name="name" value=value="<?php echo $name; ?>">
    </div>
    <div>
        <label>メールアドレス：<?php echo $mail; ?><label>
        <input type="hidden" name="mail" value=value="<?php echo $mail; ?>">
    </div>
    <div>
        <label>パスワード：<?php echo $password; ?><label>
        <input type="hidden" name="password" value=value="<?php echo $password; ?>">
    </div>
    <p>こちらの内容で登録しますか？</p>
    <input type="submit" value="登録する">
</form>
