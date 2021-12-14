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
    exit();
}

$nowEmailAddress = $_POST["formNowEmailAddress"];
$newEmailAddress = $_POST["formNewEmailAddress"];
$newEmailAddress2 = $_POST["formNewEmailAddress2"];

$sql = "
    SELECT mailAddress 
    FROM user 
    WHERE 
        userID = ?;
";
$result = execsql($conn, $sql, array($userID))->fetch();

if($result["mailAddress"] == $nowEmailAddress) {

    try {
        $conn->beginTransaction();

        $sql = "
            UPDATE user 
            SET 
                mailAddress = ? 
            WHERE 
                userID = ?;
        ";
        execsql($conn, $sql, array($newEmailAddress, $userID));

        $conn->commit();
    } catch(Exception $e) {
        die($e->getMessage());
        $conn->rollBack();
    }

} else {
    header("Location: changeEmailAddress.php");
    exit();
}

header("Location: mypage.php?ud=true&udp=ea");
exit();
