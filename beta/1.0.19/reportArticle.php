<?php

require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

// ログインしているかどうか
$login = false;
if (isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// 未ログインはログインページへ
if(!$login) {
    header("Location:login.php");
    exit();
}

if(isset($_GET["aid"]) && isset($_GET["type"])) {
    $aid = $_GET["aid"];
    $type = $_GET["type"];
    $details = isset($_GET["details"]) ? $_GET["details"] : null;
    $date = date("Y/m/d H:i:s");

    try {
        $conn->beginTransaction();

        $sql = "
            INSERT INTO reportedarticle(articleID, type, details, userID, date) 
            VALUES(?, ?, ?, ?, ?);
        ";
        execsql($conn, $sql, array($aid, $type, $details, $userID, $date));

        $conn->commit();

        $array = array("c" => true, "msg" => "報告に成功しました。");
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    } catch(Exception $e) {
        $conn->rollBack();
        $array = array("c" => false, "msg" => "報告に失敗しました。");
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
} else {
    $array = array("c" => false, "msg" => "報告に失敗しました。");
    header("Content-Type: text/javascript; charset=utf-8");
    echo(json_encode($array));
    exit();
}
