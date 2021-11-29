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

// 最新記事８件
$sql = "
    SELECT * 
    FROM article 
    ORDER BY date DESC 
    LIMIT 15;
";
$result = execsql($conn, $sql)->fetchAll();

$noimage = readImageToBase64("./image/noimage.png");  



require "php/latestArticle.php";
