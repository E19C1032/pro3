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

if(isset($_GET["workID"])) {
    $workID = $_GET["workID"];

    $sql = "SELECT * FROM article WHERE workID = ".$workID.";";
    $result = $conn->query($sql)->fetchAll();

    // 作品情報
    // wr: Work Result
    $sql = "SELECT title, titlePseudonym FROM work WHERE workID = ".$workID.";";
    $wr = $conn->query($sql)->fetch();
}

require "php/article.php";
