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

if(!$login) {
    header("Location:login.php");
    exit();
}

// ホスト？
$hostFlag = true;
for($i = 0; $i < count($host); $i++) {
    if($userID == $host[$i]) {
        $hostFlag = true;
    }
}

if(!$hostFlag) {
    header("Location:index.php");
    exit();
}

$typeStr = array(1 => "虚偽の内容", 2 => "不適切な内容", 3 => "その他");

$sql = "
    SELECT * 
    FROM reportedarticle 
    ORDER BY date DESC;
";
$result = execsql($conn, $sql);
if(empty($result)) {
    $result = array();
} else {
    $result = $result->fetchAll();
}



require "php/reportedArticle.php";
