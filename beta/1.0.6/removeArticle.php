<?php

require "php/include/pdoConnect.php";

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
    SELECT userID 
    FROM article 
    WHERE 
        articleID = " . $aid . ";";
    $uid = $conn->query($sql)->fetch()["userID"];

    // ユーザーIDが一致しているか
    if($userID == $uid) {
        try {
            $conn->beginTransaction();

            $sql = "
            DELETE FROM article 
            WHERE 
                articleID = " . $aid . ";";
            $conn->exec($sql);

            $conn->commit();
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
