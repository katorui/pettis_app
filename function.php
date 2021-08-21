<?php

function shape($text) {
    return trim(mb_convert_kana($text, "s", 'UTF-8'));
}

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function setToken() {
    // session_start();
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;
    return $csrf_token;
}

// echo setToken();
// echo "<br>";
// echo $_SESSION['csrf_token'];
