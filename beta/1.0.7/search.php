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

// キーワードが存在する？
if (isset($_GET["keyword"])) {
    $keyword = "%" . urldecode($_GET["keyword"]) . "%";
} else {
    $keyword = "%%";
}

$sql = "
    SELECT workID, title, titlePseudonym, type 
    FROM work 
    WHERE 
        title LIKE ? OR 
        titlePseudonym LIKE ?;
";
$result = execsql($conn, $sql, array($keyword, $keyword))->fetchAll();

// 行ごとのタイトル
$wrArray = array();
for ($i = 0; $i < count($result); $i++) {
    $id = $result[$i]["workID"];
    $title = $result[$i]["title"];
    $tp = $result[$i]["titlePseudonym"];
    $type = $result[$i]["type"];
    $head = mb_substr($title, 0, 1);

    $ra = array("workID" => $id, "title" => $title, "titlePseudonym" => $tp, "type" => $type);

    // タイトルの頭文字が半角英字？
    if(preg_match("/^[a-zA-Zａ-ｚＡ-Ｚ]/u", $head)) {
        $head = strtoupper(mb_convert_kana(mb_substr($title, 0, 1), "a"));
        
        $wrArray[$head][0] = null;
        array_push($wrArray[$head], $ra);
    } else {
        $headTp = mb_substr($tp, 0, 1);

        if(preg_match("/^[ぁ-んァ-ヶ]/u", $headTp)) { // かな・カナ？
            $headTp = removeDakuten(mb_substr($tp, 0, 1));
        } else { // それ以外
            $headTp = mb_substr($tp, 0, 1);
        }

        $wrArray[$headTp][0] = null;
        array_push($wrArray[$headTp], $ra);
    }

}
// キーを基準にソート
ksort($wrArray);



// 人気タイトル
$sql = "
    SELECT workID, SUM(go) as gosum 
    FROM article 
    GROUP BY workID 
    ORDER BY gosum desc 
    LIMIT 5;
";
$pr = execsql($conn, $sql)->fetchAll();

// 最新記事
$sql = "
    SELECT articleID, name 
    FROM article 
    ORDER BY date desc 
    LIMIT 5;
";
$lr = execsql($conn, $sql)->fetchAll();

// お気に入り記事
if ($login) {
    $sql = "
        SELECT * 
        FROM favoriteArticle 
        WHERE userID = ? 
        LIMIT 5;
    ";
    $fr = execsql($conn, $sql, array($userID))->fetchAll();
}



require "php/search.php";
