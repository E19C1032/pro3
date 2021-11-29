<?php

require "php/include/readIni.php";

// 利用規約ファイル読み込み
$termsOfUse = file_get_contents("./wp_contents/terms_of_use.txt");

// ログインしているかどうか
$login = false;
if (isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

require "php/createAccount.php";