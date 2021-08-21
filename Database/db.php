<?php

Class Db

{

    public function dbConnect() {

        $user = "root";
        $pass = "root";

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=pettis_app;charset=utf8',$user,$pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        } catch (Exception $e) {
            return "エラー：" . htmlspecialchars($e->getMessage(),
            ENT_QUOTES, 'UTF-8') . "<br>";
        }

    }

    // 新規登録
    public function userRegisterAdd($name,$mail,$password) {
        $dbh = $this->dbConnect();
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO users (user_name, email, password, created_at) VALUES (?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $mail, PDO::PARAM_STR);
        $stmt->bindValue(3, $password, PDO::PARAM_STR);
        $stmt->bindValue(4, $now, PDO::PARAM_STR);
        $stmt->execute();
        echo '追加成功';
    }

    public function userLogin($email) {
        $dbh = $this->dbConnect();
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$email, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function todoItemAdd($todo_item, $user_id) {
        $dbh = $this->dbConnect();
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO todo_item (user_id, todo_item, created_at) VALUES (?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $todo_item, PDO::PARAM_STR);
        $stmt->bindValue(3, $now, PDO::PARAM_STR);
        $stmt->execute();
        echo '追加成功';
    }

    public function undoneItems($id) {
        $dbh = $this->dbConnect();
        $sql = "SELECT * FROM todo_item WHERE user_id = :id AND flag = 1";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
// アイテム削除
    public function deleteItems($id) {
        $dbh = $this->dbConnect();
        $sql = "DELETE FROM todo_item WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        echo '削除成功';
    }
// 完了フラグ変更
    public function doneItems($id) {
        $dbh = $this->dbConnect();
        $sql = "UPDATE todo_item SET flag = 2 WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return 'flag変更';
    }

    // ユーザーidごとのアイテム取得
    public function getItems($id) {
        $dbh = $this->dbConnect();
        $sql = "SELECT * FROM todo_item WHERE user_id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getPage($user_id,$offset_page,$item_length) {
        $dbh = $this->dbConnect();
        $ssql = "SELECT * FROM todo_item WHERE user_id = :user_id ORDER BY id LIMIT :start, " . $item_length;
        $ssth = $dbh->prepare($ssql);
        $ssth->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $ssth->bindValue(":start", $offset_page * $item_length, PDO::PARAM_INT);
        $ssth->execute();
        $data = $ssth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

// ログインユーザーごとitem総件数取得
    public function itemCount($user_id) {
        $dbh = $this->dbConnect();
        $csql = "SELECT COUNT(*) FROM todo_item WHERE user_id = :user_id";
        $ssth = $dbh->prepare($csql);
        $ssth->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $ssth->execute();
        $item_count = $ssth->fetchAll(PDO::FETCH_ASSOC);
        return $item_count;
    }
// item詳細取得
    public function item_detail($id) {
        $dbh = $this->dbConnect();
        $sql = "SELECT * FROM todo_item WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}
