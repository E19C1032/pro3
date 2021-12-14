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

if(isset($_GET["cid"])) {
    $cid = $_GET["cid"];

    $sql = "
        SELECT userID, image 
        FROM comment 
        WHERE 
            commentID = ?;
    ";
    $result = execsql($conn, $sql, array($cid))->fetch();

    // ホスト？
    if($hostFlag || $result["userID"] == $userID) {
        try {
            $conn->beginTransaction();

            $sql = "
                DELETE FROM comment 
                WHERE 
                    commentID = ?;
            ";
            execsql($conn, $sql, array($cid));

            $conn->commit();

            if($result["image"] != null) {
                unlink("./image/" . $result["image"]);
            }

            $array = array("c" => true, "msg" => "コメントを削除しました。");
            header("Content-Type: text/javascript; charset=utf-8");
            echo(json_encode($array));
            exit();
        } catch(Exception $e) {
            $conn->rollBack();
            $array = array("c" => false, "msg" => "コメントの削除に失敗しました。");
            header("Content-Type: text/javascript; charset=utf-8");
            echo(json_encode($array));
            exit();
        }
    } else {
        $array = array("c" => false, "msg" => "コメントの削除に失敗しました。");
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
} else {
    $array = array("c" => false, "msg" => "コメントの削除に失敗しました。");
    header("Content-Type: text/javascript; charset=utf-8");
    echo(json_encode($array));
    exit();
}