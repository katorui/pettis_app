<?php

function register_name_check($input) {
        if ($input === "") {
            $_SESSION['err']['register_name'] = '※氏名は入力必須です。';
        } elseif (mb_strlen($input) > 10) {
            $_SESSION['err']['register_name'] =  '※氏名は10文字以内で入力してください';
        }
}

function email_check($input) {
        if ($input === "") {
            $_SESSION['err']['email'] = '※メールアドレスは入力必須です';
        } elseif (!$input = filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['err']['email'] = '※メールアドレスを正しい形式で入力してください';
        }
}

function password_check($input) {
        if ($input === "") {
            $_SESSION['err']['password'] = '※パスワードは入力必須です';
        } elseif (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $input)) {
            $_SESSION['err']['password'] =  '※パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください';
        }
    }

function toto_item_check($input) {
        if ($input === "") {
            $_SESSION['err']['todo_item'] = '※入力必須です';
        } elseif (mb_strlen($input) > 30) {
            $_SESSION['err']['todo_item'] = '30字以内で入力してください';
        }
}
