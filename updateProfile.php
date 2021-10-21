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
    $sql = "SELECT * FROM user WHERE userID = ".$userID.";";
    $result = $conn->query($sql)->fetch();
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
                return header("Location: changeProfile.php?err=0");
        }

        $filename = "uicon".$userID.".".$mime;

        // ユーザーアイコン
        $sql = "SELECT icon FROM user WHERE userID = ".$userID.";";
        $result = $conn->query($sql)->fetch();
        // 元々あった画像を削除
        unlink("icon/".$result["icon"]);

        $sql = "UPDATE user SET icon = '".$filename."' WHERE userID = ".$userID.";";
        $conn->exec($sql);

        file_put_contents("icon/".$filename, $data);
    }

    // ユーザー名
    if($name != "") {
        $sql = "UPDATE user SET username = '".$name."' WHERE userID = ".$userID.";";
        $conn->exec($sql);
    }

    // 一言コメント
    $sql = "UPDATE user SET uComment = '".$comment."' WHERE userID = ".$userID.";";
    $conn->exec($sql);

    file_put_contents("icon/".$filename, $data);

    $conn->commit();
} catch(Exception $e) {
    $conn->rollBack();
}

header("Location: mypage.php");
