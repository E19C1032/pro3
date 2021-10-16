<?php

require "include/readIni.php";
require "include/pdoConnect.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// ログインしているならばDBからユーザー情報を確保
if($login) {
    $sql = "SELECT * FROM user WHERE userID = ".$userID.";";
    $result = $conn->query($sql)->fetch();
}

// 検索ワードを取得
$kw = null;
if(isset($_GET["kw"])) {
    $kw = $_GET["kw"];
}

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>検索結果 - SEITI</title>

        <link rel="stylesheet" href="css/common.css?202107212014">

    </head>
    <body>
        
        <div id="container">

            <header>

                <a href="top.php"><h1>SEITI</h1></a>

            </header>

            <main>

                

            </main>

            <footer>

                <div id="version"><?php echo($ini["version"]) ?></div>

            </footer>

        </div>

    </body>
</html>
