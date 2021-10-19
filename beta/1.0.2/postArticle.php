<?php

require "php/include/readIni.php";
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

// 作品を取得
// wr: Work Result
$sql = "SELECT title FROM work;";
$wr = $conn->query($sql);



require "php/postArticle.php";

?>
