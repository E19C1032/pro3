<?php

require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

$mailAddress = $_POST["mailAddress"];
$password = $_POST["password"];

$sql = "
    SELECT userID, password 
    FROM user 
    WHERE 
        mailAddress = ?;
";
$result = execsql($conn, $sql, array($mailAddress))->fetch();

if($result["password"] == $password) {
    $_SESSION["userID"] = $result["userID"];
} else {
    header("Location: login.php?login=false");
    exit();
}

header("Location: top.php");
exit();
