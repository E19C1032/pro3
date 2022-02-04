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

if(!$login) {
    header("Location:login.php");
    exit();
}

// お気に入り記事のIDを取得
// far: Favorite Article Result
$sql = "
    SELECT articleID 
    FROM favoritearticle 
    WHERE 
        userID = ?;
";
$far = execsql($conn, $sql, array($userID));
if(empty($far)) {
    $far = array();
} else {
    $far = $far->fetchAll();
}

$noimage = readImageToBase64("./image/noimage.png");



require "php/favoriteArticle.php";
