<?php

require "php/include/readIni.php";
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
if (!$login) {
    header("Location:login.php");
}

$nowPassword = $_POST["formNowPassword"];
$newPassword = $_POST["formNewPassword"];
$newPassword2 = $_POST["formNewPassword2"];

$sql = "SELECT password FROM user WHERE userID = ".$userID.";";
$result = $conn->query($sql)->fetch();

if($result["password"] == $nowPassword) {

    try {
        $conn->beginTransaction();

        $sql = "UPDATE user SET password = '".$newPassword."' WHERE userID = ".$userID.";";
        $conn->exec($sql);

        $conn->commit();
    } catch(Exception $e) {
        die($e->getMessage());
        $conn->rollBack();
    }

}

header("Location: mypage.php");
