<?php

require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// 未ログインはログインページへ
if(!$login) {
    header("Location:login.php");
    exit();
}

if(isset($_GET["aid"])) {
    $uid = $_SESSION["userID"];
    $aid = $_GET["aid"];

    $comment = $_POST["formCommentComment"];
    if(strlen($comment) == 0)
        $comment = null;

    if(strlen($_FILES["formCommentImage"]["name"]) > 0) {
        $image = $_FILES["formCommentImage"];
        $tempfile = $_FILES["formCommentImage"]["tmp_name"];

        $mime = explode("/", getimagesize($tempfile)["mime"])[1];
        $id = uniqid();
        $dir = "./image";
        $filename = $id.".".$mime;
    } else {
        $filename = null;
    }

    try {
        $conn->beginTransaction();

        $sql = "
            INSERT INTO comment(articleID, userID, comment, image) 
            VALUES(?, ?, ?, ?);
        ";
        execsql($conn, $sql, array($aid, $uid, $comment, $filename));

        if($filename != null) {
            if(is_uploaded_file($tempfile)) {
                if(move_uploaded_file($tempfile, $dir."/".$filename)) {
                    echo($filename."をアップロードしました。");
                } else {
                    echo("アップロードに失敗しました。");
                    throw new Exception("例外");
                }
            } else {
                echo("ファイルが選択されていません。");
                throw new Exception("例外");
            }
        }

        $conn->commit();
    } catch(Exception $e) {
        $conn->rollBack();
        die($e->getMessage());
    }
}

header("Location:view.php?v=".$aid);
exit();
