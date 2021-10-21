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

$nowEmailAddress = $_POST["formNowEmailAddress"];
$newEmailAddress = $_POST["formNewEmailAddress"];
$newEmailAddress2 = $_POST["formNewEmailAddress2"];

$sql = "SELECT mailAddress FROM user WHERE userID = ".$userID.";";
$result = $conn->query($sql)->fetch();

if($result["mailAddress"] == $nowEmailAddress) {

    try {
        $conn->beginTransaction();

        $sql = "UPDATE user SET mailAddress = '".$newEmailAddress."' WHERE userID = ".$userID.";";
        $conn->exec($sql);

        $conn->commit();
    } catch(Exception $e) {
        die($e->getMessage());
        $conn->rollBack();
    }

}

header("Location: mypage.php");
