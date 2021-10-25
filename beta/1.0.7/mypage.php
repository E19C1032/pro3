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

if(isset($_GET["uid"])) {
    $uid = $_GET["uid"];

    if($login) {
        if($userID == $uid) {
            $page = "me";
        } else {
            $page = "other";
        }
    } else {
        $page = "other";
    }
} else {
    if($login) {
        $page = "me";
    } else {
        header("Location: login.php");
        exit();
    }
}

if($page == "me") {
    // ユーザー情報を取得
    $sql = "
        SELECT * 
        FROM user 
        WHERE 
            userID = ?;
    ";
    $result = execsql($conn, $sql, array($userID))->fetch();

    // 投稿記事情報を取得
    // ar: Article Result
    $sql = "
        SELECT * 
        FROM article 
        WHERE 
            userID = ? 
        ORDER BY date DESC;
    ";
    $ar = execsql($conn, $sql, array($userID))->fetchAll();
} else if($page == "other") {
    // ユーザー情報を取得
    $sql = "
        SELECT * 
        FROM user 
        WHERE 
            userID = ?;
    ";
    $result = execsql($conn, $sql, array($uid))->fetch();

    // 投稿記事情報を取得
    // ar: Article Result
    $sql = "
        SELECT * 
        FROM article 
        WHERE 
            userID = ? 
        ORDER BY date DESC;
    ";
    $ar = execsql($conn, $sql, array($uid))->fetchAll();
}



require "php/mypage.php";
