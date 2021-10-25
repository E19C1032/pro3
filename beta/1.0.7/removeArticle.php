<?php

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

if(isset($_GET["aid"])) {
    $aid = $_GET["aid"];

    $sql = "
        SELECT userID, image 
        FROM article 
        WHERE 
            articleID = ?;
    ";
    $result = execsql($conn, $sql, array($aid))->fetch();

    // ユーザーIDが一致しているか
    if($userID == $result["userID"]) {
        try {
            $conn->beginTransaction();

            $sql = "
                DELETE FROM go 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

            $sql = "
                DELETE FROM favoriteArticle 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

            $sql = "
                SELECT image 
                FROM comment 
                WHERE 
                    articleID = ?;
            ";
            $cImages = execsql($conn, $sql, array($aid))->fetchAll();

            $sql = "
                DELETE FROM comment 
                WHERE 
                    articleID = ?;
            ";
            execsql($conn, $sql, array($aid));

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

$array = array("c" => true, "msg" => "記事を削除しました。");
header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
exit();
