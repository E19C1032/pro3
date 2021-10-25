<?php

require "php/include/readIni.php";
require "php/include/pdoConnect.php";

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
    exit();
}

// 作品を取得
// wr: Work Result
$sql = "
SELECT title, titlePseudonym, type 
FROM work;";
$wr = $conn->query($sql);

// 下書きを取得
// dr: Draft Result
$sql = "
SELECT * 
FROM draft 
WHERE 
    userID = ".$userID.";";
$dr = $conn->query($sql)->fetchAll();



require "php/postArticle.php";
