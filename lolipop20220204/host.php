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

$hostFlag = false;
for($i = 0; $i < count($host); $i++) {
    if($userID == $host[$i]) {
        $hostFlag = true;
    }
}

if(!$hostFlag) {
    header("Location:index.php");
    exit();
}



$sql = "
    SELECT article.userID AS userID, COUNT(*) AS count 
    FROM reportedarticle 
    LEFT JOIN article 
    ON reportedarticle.articleID = article.articleID 
    GROUP BY article.userID 
    ORDER BY count DESC;
";
$report = execsql($conn, $sql);
if(empty($report)) {
    $report = array();
} else {
    $report = $report->fetchAll();
}



require "php/host.php";