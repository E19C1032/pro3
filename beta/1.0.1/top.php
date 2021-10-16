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

// ログインしているならばDBからユーザー情報を確保
if ($login) {
    $sql = "SELECT * FROM user WHERE userID = " . $userID . ";";
    $result = $conn->query($sql)->fetch();
}

// 最新記事
// lar: Latest Article Result
$sql = "SELECT * FROM article ORDER BY date DESC LIMIT 3;";
$lar = $conn->query($sql)->fetchAll();

// お気に入り記事のID
// air: Article ID Result
if ($login) {
    $sql = "SELECT articleID FROM favoriteArticle WHERE userID = " . $userID . ";";
    $air = $conn->query($sql)->fetchAll();
}



require "php/top.php";

?>
