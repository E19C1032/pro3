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
}

// パラメータがセットされているかどうか
if(isset($_GET["aid"])) {
    $aid = $_GET["aid"];
} else {
    header("Location:mypage.php");
}

// 記事がログインユーザーの物であるか検証
// ar: Auth Result
$sql = "SELECT userID FROM article WHERE articleID = ".$aid.";";
$ar = $conn->query($sql)->fetch()["userID"];
if($userID != $ar) {
    header("Location:mypage.php");
}

// 記事情報
$sql = "SELECT * from article WHERE articleID = ".$aid.";";
$result = $conn->query($sql)->fetch();

// 記事の作品タイトル
// wr: Work Result
$sql = "SELECT title FROM work WHERE workID = ".$result["workID"].";";
$wr = $conn->query($sql)->fetch();

// 作品を取得
// awr: All Work Result
$sql = "SELECT title FROM work;";
$awr = $conn->query($sql);



require "php/repostArticle.php";

?>
