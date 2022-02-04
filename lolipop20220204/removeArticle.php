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

// ホスト？
$hostFlag = false;
if($login) {
    for($i = 0; $i < count($host); $i++) {
        if($userID == $host[$i]) {
            $hostFlag = true;
        }
    }
}

if(isset($_GET["aid"])) {
    $aid = $_GET["aid"];

    $sql = "
        SELECT userID, image 
        FROM article 
        WHERE 
            articleID = ?;
    ";
    $result = execsql($conn, $sql, array($aid))->fetch();

    // ユーザーIDが一致しているか、もしくはホストか
    if($userID == $result["userID"] || $hostFlag) {
        try {
            $conn->beginTransaction();

            // go
            $sql = "
                DELETE FROM go 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

            // favoriteArticle
            $sql = "
                DELETE FROM favoritearticle 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

            // コメント画像
            $sql = "
                SELECT image 
                FROM comment 
                WHERE 
                    articleID = ?;
            ";
            $cImages = execsql($conn, $sql, array($aid))->fetchAll();

            // comment
            $sql = "
                DELETE FROM comment 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

            // reportedArticle
            $sql = "
                DELETE FROM reportedarticle 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

            // article
            $sql = "
                DELETE FROM article 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

            $conn->commit();

            if($result["image"] != null) {
                unlink("./image/" . $result["image"]);
            }

            for($i = 0; $i < count($cImages); $i++) {
                unlink("./image/" . $cImages[$i]["image"]);
            }

            $array = array("c" => true, "msg" => "記事を削除しました。");
            header("Content-Type: text/javascript; charset=utf-8");
            echo(json_encode($array));
            exit();
        } catch(Exception $e) {
            $conn->rollBack();
            $array = array("c" => false, "msg" => "記事の削除に失敗しました。");
            header("Content-Type: text/javascript; charset=utf-8");
            echo(json_encode($array));
            exit();
        }
    } else {
        $array = array("c" => false, "msg" => "記事の削除に失敗しました。");
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
} else {
    $array = array("c" => false, "msg" => "記事の削除に失敗しました。");
    header("Content-Type: text/javascript; charset=utf-8");
    echo(json_encode($array));
    exit();
}
