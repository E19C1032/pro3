<?php

require "include/pdoConnect.php";

session_start();

if(isset($_SESSION["userID"]) && isset($_GET["aid"])) {
    $uid = $_SESSION["userID"];
    $aid = $_GET["aid"];

    try {
        $conn->beginTransaction();

        $sql = "INSERT INTO favoriteArticle(userID, articleID) VALUES(".$uid.", ".$aid.");";
        $conn->exec($sql);

        $conn->commit();

        $array = array("c" => true);
    } catch(Exception $e) {
        $conn->rollBack();
        $array = array("c" => false);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
    }
} else {
    $array = array("c" => false);
}

header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
