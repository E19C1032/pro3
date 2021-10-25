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

if(isset($_GET["did"])) {
    $did = $_GET["did"];

    $sql = "
    SELECT userID 
    FROM draft 
    WHERE 
        draftID = " . $did . ";";
    $uid = $conn->query($sql)->fetch()["userID"];

    // ユーザーの下書きか？
    if($userID == $uid) {
        try {
            $conn->beginTransaction();

            $sql = "
            DELETE FROM draft 
            WHERE 
                draftID = " . $did . ";";
            $conn->exec($sql);

            $conn->commit();
        } catch(Exception $e) {
            $conn->rollBack();
            $array = array("c" => false, "msg" => "下書きの削除に失敗しました。");
            header("Content-Type: text/javascript; charset=utf-8");
            echo(json_encode($array));
            exit();
        }
    } else {
        $array = array("c" => false, "msg" => "下書きの削除に失敗しました。");
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
} else {
    $array = array("c" => false, "msg" => "下書きの削除に失敗しました。");
    header("Content-Type: text/javascript; charset=utf-8");
    echo(json_encode($array));
    exit();
}

$array = array("c" => true, "msg" => "下書きを削除しました。");
header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
exit();
