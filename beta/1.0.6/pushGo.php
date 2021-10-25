<?php

require "php/include/pdoConnect.php";

session_start();

if(isset($_SESSION["userID"]) && isset($_GET["aid"])) {
    $uid = $_SESSION["userID"];
    $aid = $_GET["aid"];

    try {
        $conn->beginTransaction();

        $sql = "
        INSERT INTO go(userID, articleID) 
        VALUES(".$uid.", ".$aid.");";
        $conn->exec($sql);

        $sql = "
        UPDATE article 
        SET go = go + 1 
        WHERE 
            articleID = ".$aid.";";
        $conn->exec($sql);

        $sql = "
        SELECT go 
        FROM article 
        WHERE 
            articleID = ".$aid.";";
        $gr = $conn->query($sql)->fetch();

        $conn->commit();

        $array = array("c" => true, "go" => $gr["go"]);
    } catch(Exception $e) {
        $conn->rollBack();
        $array = array("c" => false, "go" => $gr["go"]);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
} else {
    $array = array("c" => false, "go" => $gr["go"]);
}

header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
exit();
