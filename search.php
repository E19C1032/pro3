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

if (isset($_GET["keyword"])) {
    $keyword = urldecode($_GET["keyword"]);
} else {
    $keyword = "";
}
$sql = "SELECT workID, title, titlePseudonym FROM work WHERE title LIKE '%" . $keyword . "%' OR titlePseudonym LIKE '%" . $keyword . "%' ORDER BY CAST(titlePseudonym AS CHAR);";
$result = $conn->query($sql)->fetchAll();

$wrArray = array();

for ($i = 0; $i < count($result); $i++) {
    $id = $result[$i]["workID"];
    $title = $result[$i]["title"];
    $tp = $result[$i]["titlePseudonym"];
    $head = mb_substr($tp, 0, 1);

    $wrArray[$head][0] = null;
    $ra = array("workID" => $id, "title" => $title, "titlePseudonym" => $tp);
    array_push($wrArray[$head], $ra);
}

// var_dump($wrArray);

$sql = "SELECT workID, SUM(go) as gosum FROM article GROUP BY workID ORDER BY gosum desc LIMIT 5;";
$pr = $conn->query($sql)->fetchAll();

$sql = "SELECT articleID, name FROM article ORDER BY date desc LIMIT 5;";
$lr = $conn->query($sql)->fetchAll();

if ($login) {
    $sql = "SELECT * FROM favoriteArticle WHERE userID = " . $userID . " LIMIT 5;";
    $fr = $conn->query($sql)->fetchAll();
}



require "php/search.php";