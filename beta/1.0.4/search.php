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

if(isset($_GET["keyword"])) {
    $keyword = urldecode($_GET["keyword"]);
} else {
    $keyword = "";
}
$sql = "SELECT workID, title FROM work WHERE title LIKE '%".$keyword."%' OR titlePseudonym LIKE '%".$keyword."%' ORDER BY CAST(title AS CHAR) desc;";
$result = $conn->query($sql)->fetchAll();

$sql = "SELECT workID, SUM(go) as gosum FROM article GROUP BY workID ORDER BY gosum desc LIMIT 5;";
$pr = $conn->query($sql)->fetchAll();

$sql = "SELECT articleID, name FROM article ORDER BY date desc LIMIT 5;";
$lr = $conn->query($sql)->fetchAll();

if($login) {
    $sql = "SELECT * FROM favoriteArticle WHERE userID = ".$userID." LIMIT 5;";
    $fr = $conn->query($sql)->fetchAll();
}



require "php/search.php";
