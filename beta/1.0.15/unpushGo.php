<?php

require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

if(isset($_SESSION["userID"]) && isset($_GET["aid"])) {
    $uid = $_SESSION["userID"];
    $aid = $_GET["aid"];

    try {
        $conn->beginTransaction();

        $sql = "
            DELETE FROM go 
            WHERE 
                userID = ? AND 
                articleID = ?;
        ";
        execsql($conn, $sql, array($uid, $aid));

        $sql = "
            UPDATE article 
            SET go = go - 1 
            WHERE 
                articleID = ?;
        ";
        execsql($conn, $sql, array($aid));

        $sql = "
            SELECT go 
            FROM article 
            WHERE 
                articleID = ?;
        ";
        $gr = execsql($conn, $sql, array($aid))->fetch();

        $conn->commit();

        $array = array("c" => true, "go" => $gr["go"]);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    } catch(Exception $e) {
        $conn->rollBack();
        $array = array("c" => false, "go" => $gr["go"]);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
} else {
    $array = array("c" => false, "go" => $gr["go"]);
    header("Content-Type: text/javascript; charset=utf-8");
    echo(json_encode($array));
    exit();
}
