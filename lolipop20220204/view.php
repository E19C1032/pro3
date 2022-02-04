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

$mode = "normal";
if(isset($_GET["mode"])) {
    $mode = $_GET["mode"];
}

// ホスト？
$hostFlag = false;
if($login) {
    for($i = 0; $i < count($host); $i++) {
        if($userID == $host[$i]) {
            $hostFlag = true;
        }
    }
}

// 対象の記事情報を取得
$articleID = $_GET["v"];
$nf = false;

// 無効な記事？
if($articleID == "NF") {
    $nf = true;
} else {
    // 対象の記事を取得
    $sql = "
        SELECT * 
        FROM article 
        WHERE 
            articleID = ?;
    ";
    $result = execsql($conn, $sql, array($articleID))->fetch();
    if(!$result) {
        header("Location:view.php?v=NF");
        exit();
    }

    // ユーザー情報を取得
    $sql = "
        SELECT userID, username, icon 
        FROM user 
        WHERE 
            userID = ?;
    ";
    $ur = execsql($conn, $sql, array($result["userID"]))->fetch();

    // 作品名を取得
    // wr: Work Result
    $sql = "
        SELECT title 
        FROM work 
        WHERE 
            workID = ?;
    ";
    $wr = execsql($conn, $sql, array($result["workID"]))->fetch();

    // コメントを取得
    // cr: Comment Reasult
    $sql = "
        SELECT * 
        FROM comment 
        WHERE 
            articleID = ?;
    ";
    $cr = execsql($conn, $sql, array($articleID))->fetchAll();

    // ログイン時
    // uaar: User and Article Result
    // far: Favorite Article Result
    if($login) {
        $sql = "
            SELECT * 
            FROM go 
            WHERE 
                userID = ? AND 
                articleID = ?;
        ";
        $uaar = execsql($conn, $sql, array($userID, $articleID))->fetch();

        $sql = "
            SELECT * 
            FROM favoritearticle 
            WHERE 
                userID = ? AND 
                articleID = ?;
        ";
        $far = execsql($conn, $sql, array($userID, $articleID));
        if(empty($far)) {
            $far = false;
        } else {
            $far = $far->fetch();
        }
    }
}



require "php/view.php";