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
        userID = ".$userID.";";
    $result = $conn->query($sql)->fetch();
}

// アイコンが設定されていないならば初期アイコンを表示
if($result["icon"] == null) {
    $filename = "default_icon.png";
} else {
    $filename = $result["icon"];
}

$iconSrc = readImageToBase64("./icon/".$filename);



require "php/changeProfile.php";
