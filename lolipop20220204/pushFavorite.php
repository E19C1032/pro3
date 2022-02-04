<?php

require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

$error = 0;
if(isset($_SESSION["userID"]) && isset($_GET["aid"])) {
    $uid = $_SESSION["userID"];
    $aid = $_GET["aid"];

    try {
        $conn->beginTransaction();

        $sql = "
            SELECT COUNT(*) AS c 
            FROM favoritearticle 
            WHERE 
                userID = ?;
        ";
        $fcount = (int)execsql($conn, $sql, array($uid))->fetch()["c"];

        if($fcount < 50) {
            $sql = "
                INSERT INTO favoritearticle(userID, articleID) 
                VALUES(?, ?);
            ";
            execsql($conn, $sql, array($uid, $aid));
        } else {
            $error = 2;
        }

        $conn->commit();

        $array = array("c" => true, "fcount" => $fcount, "error" => $error);
    } catch(Exception $e) {
        $conn->rollBack();
        $error = 3;
        $array = array("c" => false, "error" => $error);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
} else {
    $error = 1;
    $array = array("c" => false, "error" => $error);
}

header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
exit();
