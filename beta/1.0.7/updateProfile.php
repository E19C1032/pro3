<?php

require "php/include/readIni.php";
require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// ログインしているならばDBからユーザー情報を確保
if($login) {
    $sql = "
        SELECT * 
        FROM user 
        WHERE 
            userID = ?;
    ";
    $result = execsql($conn, $sql, array($userID))->fetch();
}

$icon = $_POST["formHUserIcon"];
$name = $_POST["formUsername"];
$comment = $_POST["formUserComment"];

try {
    $conn->beginTransaction();

    // ユーザーアイコンのアップデート
    if($icon != "") {
        $icon = explode(",", $icon)[1];
        $data = base64_decode($icon);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $data);

        switch($mimeType) {
            case "image/jpeg":
                $mime = "jpg";
                break;
            
            case "image/png":
                $mime = "png";
                break;

            default:
                header("Location: changeProfile.php?err=0");
                exit();
        }

        $filename = "uicon".$userID.".".$mime;

        // ユーザーアイコン
        $sql = "
            SELECT icon 
            FROM user 
            WHERE 
                userID = ?;
        ";
        $result = execsql($conn, $sql, array($userID))->fetch();
        // 元々あった画像を削除
        unlink("icon/".$result["icon"]);

        $sql = "
            UPDATE user 
            SET 
                icon = ? 
            WHERE 
                userID = ?;
        ";
        execsql($conn, $sql, array($filename, $userID));

        file_put_contents("icon/".$filename, $data);
    }

    // ユーザー名
    if($name != "") {
        $sql = "
            UPDATE user 
            SET 
                username = ? 
            WHERE 
                userID = ?;
        ";
        execsql($conn, $sql, array($name, $userID));
    }

    // 一言コメント
    $sql = "
        UPDATE user 
        SET 
            uComment = ? 
        WHERE 
            userID = ?;
    ";
    execsql($conn, $sql, array($comment, $userID));

    file_put_contents("icon/".$filename, $data);

    $conn->commit();
} catch(Exception $e) {
    $conn->rollBack();
}

header("Location: mypage.php");
exit();
