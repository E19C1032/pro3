<?php

require "php/include/readIni.php";
require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

// 最新記事８件
$sql = "SELECT * FROM article ORDER BY date DESC LIMIT 8;";
$result = $conn->query($sql)->fetchAll();



require "php/latestArticle.php";

?>
