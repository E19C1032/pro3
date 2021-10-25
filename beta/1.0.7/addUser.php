<?php

require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

$username = $_POST["username"];
$mailAddress = $_POST["mailAddress"];
$password = $_POST["password"];

try {
    $conn->beginTransaction();

    $sql = "
        INSERT INTO user(username, mailAddress, password) 
        VALUES(?, ?, ?);
    ";
    execsql($conn, $sql, array($username, $mailAddress, $password));

    $conn->commit();

    $sql = "
        SELECT userID 
        FROM user 
        WHERE 
            mailAddress = ?;
    ";
    $result = execsql($conn, $sql, array($mailAddress))->fetch();

    $_SESSION["userID"] = $result["userID"];
} catch(Exception $e) {
    $conn->rollBack();
    header("Location: createAccount.php");
    exit();
}

header("Location: top.php");
exit();
