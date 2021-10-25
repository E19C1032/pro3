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
    exit();
}

// 作品を取得
// wr: Work Result
$sql = "
    SELECT title, titlePseudonym, type 
    FROM work;
";
$wr = execsql($conn, $sql)->fetchAll();

// 下書きを取得
// dr: Draft Result
$sql = "
    SELECT * 
    FROM draft 
    WHERE 
        userID = ?;
";
$dr = execsql($conn, $sql, array($userID))->fetchAll();



require "php/postArticle.php";
