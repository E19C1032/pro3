<?php

require "include/pdoConnect.php";

session_start();

if(isset($_SESSION["userID"]) && isset($_GET["aid"])) {
    $uid = $_SESSION["userID"];
    $aid = $_GET["aid"];

    try {
        $conn->beginTransaction();

        $sql = "DELETE FROM go WHERE userID = ".$uid." AND articleID = ".$aid.";";
        $conn->exec($sql);

        $sql = "UPDATE article SET go = go - 1 WHERE articleID = ".$aid.";";
        $conn->exec($sql);

        $sql = "SELECT go FROM article WHERE articleID = ".$aid.";";
        $gr = $conn->query($sql)->fetch();

        $conn->commit();

        $array = array("c" => true, "go" => $gr["go"]);
    } catch(Exception $e) {
        $conn->rollBack();
        $array = array("c" => false, "go" => $gr["go"]);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
    }
} else {
    $array = array("c" => false, "go" => $gr["go"]);
}

header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
