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

$nowPassword = $_POST["formNowPassword"];
$newPassword = $_POST["formNewPassword"];
$newPassword2 = $_POST["formNewPassword2"];

$sql = "
    SELECT password 
    FROM user 
    WHERE 
        userID = ?;
";
$result = execsql($conn, $sql, array($userID))->fetch();

if($result["password"] == $nowPassword) {

    try {
        $conn->beginTransaction();

        $sql = "
            UPDATE user 
            SET 
                password = ? 
            WHERE 
                userID = ?;
        ";
        execsql($conn, $sql, array($newPassword, $userID));

        $conn->commit();
    } catch(Exception $e) {
        die($e->getMessage());
        $conn->rollBack();
    }

} else {
    header("Location: changePassword.php");
    exit();
}

header("Location: mypage.php");
exit();
