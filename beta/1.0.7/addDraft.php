<?php

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
if(!$login) {
    header("Location:login.php");
    exit();
}

$sql = "
    SELECT COUNT(*) 
    AS c 
    FROM draft 
    WHERE 
        userID = ?;
";
$count = execsql($conn, $sql, array($userID))->fetch()["c"];

if($count >= 6) {
    $array = array("c" => false, "msg" => "これ以上下書きを保存できません。");
} else {

    if(isset($_POST["name"]) && isset($_POST["title"]) && isset($_POST["titlePseudonym"]) && isset($_POST["type"]) && isset($_POST["prefecture"]) && isset($_POST["municipality"]) && isset($_POST["last"]) && isset($_POST["details"]) && isset($_POST["image"])) {
        $name = $_POST["name"];
        $title = $_POST["title"];
        $titlePseudonym = $_POST["titlePseudonym"];
        $type = $_POST["type"];
        $prefecture = $_POST["prefecture"];
        $municipality = $_POST["municipality"];
        $last = $_POST["last"];
        $details = $_POST["details"];
        $image = $_POST["image"];
        $image = str_replace(" ", "+", $image);

        try {
            if(strlen($image) > 0) {
                $data = base64_decode($image);
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
                        header("Location: postArticle.php?err=0");
                        exit();
                }
                
                $id = uniqid();
                $dir = "./image";
                $filename = $id.".".$mime;
        
                file_put_contents($dir."/".$filename, $data);
            } else {
                $filename = null;
            }

            $conn->beginTransaction();

            $sql = "
                INSERT INTO draft(userID, title, titlePseudonym, type, image, name, sAddress1, sAddress2, sAddress3, details) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
            ";
            execsql($conn, $sql, array($userID, $title, $titlePseudonym, $type, $filename, $name, $prefecture, $municipality, $last, $details));

            $conn->commit();
        } catch(Exception $e) {
            $conn->rollBack();
            $array = array("c" => false, "msg" => "下書きの保存に失敗しました。");
            header("Content-Type: text/javascript; charset=utf-8");
            echo(json_encode($array));
            exit();
        }

        $array = array("c" => true, "msg" => "下書きの保存に成功しました。");
    } else {
        $array = array("c" => false, "msg" => "下書きの保存に失敗しました。");
    }

}

header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
exit();
