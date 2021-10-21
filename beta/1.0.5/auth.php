<?php

require "php/include/pdoConnect.php";

session_start();

$mailAddress = $_POST["mailAddress"];
$password = $_POST["password"];

$sql = "SELECT userID, password FROM user WHERE mailAddress = '".$mailAddress."';";
$result = $conn->query($sql)->fetch();

if($result["password"] == $password) {
    $_SESSION["userID"] = $result["userID"];
    header("Location:top.php");
} else {
    header("Location:login.php?login=false");
}
