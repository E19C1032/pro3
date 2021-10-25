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
    articleID = ".$aid.";";
$ar = $conn->query($sql)->fetch()["userID"];
if($userID != $ar) {
    header("Location:mypage.php");
    exit();
}

// 記事情報
$sql = "
SELECT * 
FROM article 
WHERE 
    articleID = ".$aid.";";
$result = $conn->query($sql)->fetch();

// 記事の作品タイトル
// wr: Work Result
$sql = "
SELECT title, titlePseudonym 
FROM work 
WHERE 
    workID = ".$result["workID"].";";
$wr = $conn->query($sql)->fetch();

// 作品を取得
// awr: All Work Result
$sql = "
SELECT title, titlePseudonym, type 
FROM work;";
$awr = $conn->query($sql);

// 下書きを取得
// dr: Draft Result
$sql = "
SELECT * 
FROM draft 
WHERE 
    userID = ".$userID.";";
$dr = $conn->query($sql)->fetchAll();



require "php/repostArticle.php";
