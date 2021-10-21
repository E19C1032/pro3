<?php

require "php/include/readIni.php";
require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

// ログインしているかどうか
$login = false;
if (isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// 未ログインはログインページへ
if (!$login) {
    header("Location:login.php");
}

// ユーザー情報を取得
$sql = "SELECT * FROM user WHERE userID = " . $userID . ";";
$result = $conn->query($sql)->fetch();

// 投稿記事情報を取得
// ar: Article Result
$sql = "SELECT * FROM article WHERE userID = " . $userID . ";";
$ar = $conn->query($sql)->fetchAll();



require "php/mypage.php";

?>
