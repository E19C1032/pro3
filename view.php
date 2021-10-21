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

// 対象の記事情報を取得
$articleID = $_GET["v"];
$nf = false;

// 無効な記事？
if($articleID == "NF") {
    $nf = true;
} else {
    // 対象の記事を取得
    $sql = "SELECT * FROM article WHERE articleID = ".$articleID.";";
    $result = $conn->query($sql)->fetch();
    if(!$result) {
        header("Location:view.php?v=NF");
    }

    // 作品名を取得
    // wr: Work Result
    $sql = "SELECT title FROM work WHERE workID = ".$result["workID"].";";
    $wr = $conn->query($sql)->fetch();

    // コメントを取得
    // cr: Comment Reasult
    $sql = "SELECT * FROM comment WHERE articleID = ".$articleID.";";
    $cr = $conn->query($sql)->fetchAll();

    // ログイン時
    // uaar: User and Article Result
    // far: Favorite Article Result
    if($login) {
        $sql = "SELECT * FROM go WHERE userID = ".$userID." AND articleID = ".$articleID.";";
        $uaar = $conn->query($sql)->fetch();

        $sql = "SELECT * FROM favoriteArticle WHERE userID = ".$userID." AND articleID = ".$articleID.";";
        $far = $conn->query($sql)->fetch();
    }
}



require "php/view.php";

?>
