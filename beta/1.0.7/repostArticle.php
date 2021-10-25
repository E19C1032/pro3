<?php

require "php/include/readIni.php";
require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// 未ログインはログインページへ
if(!$login) {
    header("Location:login.php");
    exit();
}

// パラメータがセットされているかどうか
if(isset($_GET["aid"])) {
    $aid = $_GET["aid"];
} else {
    header("Location:mypage.php");
    exit();
}

// 記事がログインユーザーの物であるか検証
// ar: Auth Result
$sql = "
    SELECT userID 
    FROM article 
    WHERE 
        articleID = ?;
";
$ar = execsql($conn, $sql, array($aid))->fetch()["userID"];
if($userID != $ar) {
    header("Location:mypage.php");
    exit();
}

// 記事情報
$sql = "
    SELECT * 
    FROM article 
    WHERE 
        articleID = ?;
";
$result = execsql($conn, $sql, array($aid))->fetch();

// 記事の作品タイトル
// wr: Work Result
$sql = "
    SELECT title, titlePseudonym 
    FROM work 
    WHERE 
        workID = ?;
";
$wr = execsql($conn, $sql, array($result["workID"]))->fetch();

// 作品を取得
// awr: All Work Result
$sql = "
    SELECT title, titlePseudonym, type 
    FROM work;
";
$awr = execsql($conn, $sql);

// 下書きを取得
// dr: Draft Result
$sql = "
    SELECT * 
    FROM draft 
    WHERE 
        userID = ?;
";
$dr = execsql($conn, $sql, array($userID))->fetchAll();



require "php/repostArticle.php";
