<?php

require "php/include/pdoConnect.php";

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

if(isset($_GET["did"])) {
    $did = $_GET["did"];

    $sql = "SELECT userID FROM draft WHERE draftID = ".$did.";";
    $uid = $conn->query($sql)->fetch()["userID"];
    if($userID == $uid) {
        $sql = "SELECT * FROM draft WHERE draftID = ".$did.";";
        $result = $conn->query($sql)->fetch();

        $base64 = "";
        $ext = "";
        if($result["image"] != null) {
            $dir = "./image";
            $filename = $result["image"];
            $ext = explode(".", $filename)[1];
            $path = $dir."/".$filename;
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
        }
        $array = array("c" => true,  "result" => $result, "imageSrc" => $base64, "imageExt" => $ext);
    } else {
        $array = array("c" => false,  "result" => null, "imageSrc" => "");
    }
} else {
    $array = array("c" => false,  "result" => null, "imageSrc" => "");
}

header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
