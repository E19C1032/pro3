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

if(isset($_GET["wid"])) {
    $workID = $_GET["wid"];

    $sql = "
        SELECT * 
        FROM article 
        WHERE 
            workID = ? 
        ORDER BY date DESC;
    ";
    $result = execsql($conn, $sql, array($workID))->fetchAll();

    // 作品情報
    // wr: Work Result
    $sql = "
        SELECT title, titlePseudonym 
        FROM work 
        WHERE 
            workID = ?;
    ";
    $wr = execsql($conn, $sql, array($workID))->fetch();
}



require "php/article.php";
