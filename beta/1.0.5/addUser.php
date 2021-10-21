<?php

require "php/include/pdoConnect.php";

session_start();

$username = $_POST["username"];
$mailAddress = $_POST["mailAddress"];
$password = $_POST["password"];

try {
    $conn->beginTransaction();

    $sql = "INSERT INTO user(username, mailAddress, password) VALUES('".$username."', '".$mailAddress."', '".$password."');";
    $conn->exec($sql);

    $conn->commit();

    $sql = "SELECT userID FROM user WHERE mailAddress = '".$mailAddress."';";
    $result = $conn->query($sql)->fetch();

    $_SESSION["userID"] = $result["userID"];

    header("Location:top.php");
} catch(Exception $e) {
    $conn->rollBack();
    die($e->getMessage());
}
