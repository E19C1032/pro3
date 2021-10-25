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
    $sql = "
        SELECT * 
        FROM user 
        WHERE 
            userID = ?;
    ";
    $result = execsql($conn, $sql, array($userID))->fetch();
}

// 最新記事
// lar: Latest Article Result
$sql = "
    SELECT * 
    FROM article 
    ORDER BY date DESC 
    LIMIT 3;
";
$lar = execsql($conn, $sql)->fetchAll();

// お気に入り記事のID
// air: Article ID Result
if ($login) {
    $sql = "
        SELECT articleID 
        FROM favoriteArticle 
        WHERE 
            userID = ?;
    ";
    $air = execsql($conn, $sql, array($userID))->fetchAll();
}

// 人気タイトル
// pr: Popular Article Result
$sql = "
    SELECT workID, SUM(go) as gosum 
    FROM article 
    GROUP BY workID 
    ORDER BY gosum DESC 
    LIMIT 5;
";
$par = execsql($conn, $sql)->fetchAll();



require "php/top.php";
