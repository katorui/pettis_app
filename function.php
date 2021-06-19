<?php

function shape($text) {
    return trim(mb_convert_kana($text, "s", 'UTF-8'));
}
