<?php

require "php/include/pdoConnect.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// 未ログインはログインページへ
if(!$login) {
    header("Location:login.php");
}

// 必須項目がPOSTに存在するか？
if(isset($_POST["formPostName"]) && isset($_POST["formPostWork"]) && isset($_POST["formPostWorkPseudonym"]) && isset($_POST["selectPrefecture"]) && isset($_POST["formPostMunicipality"]) && isset($_POST["formPostLast"])) {
    // 必須項目
    $name = $_POST["formPostName"];
    $work = $_POST["formPostWork"];
    $workPseudonym = $_POST["formPostWorkPseudonym"];
    $sAddress1 = $_POST["selectPrefecture"];
    $sAddress2 = $_POST["formPostMunicipality"];
    $sAddress3 = $_POST["formPostLast"];
    $date = date("Y/m/d H:i:s");

    // 作品タイトルが存在しない場合、追加する
    $sql = "SELECT EXISTS(SELECT title FROM work WHERE title = '".$work."') AS existsWork;";
    $existsWork = $conn->query($sql)->fetch()["existsWork"];

    if(!$existsWork) {
        $sql = "INSERT INTO work(title, titlePseudonym, type) VALUES('".$work."', '".$workPseudonym."', 1);";
        $conn->exec($sql);
    }

    // 作品ID
    $sql = "SELECT workID FROM work WHERE title = '".$work."';";
    $workID = $conn->query($sql)->fetch()["workID"];

    // 任意項目
    if(isset($_POST["formPostDetails"]) && strlen($_POST["formPostDetails"]) > 0) {
        $details = $_POST["formPostDetails"];
    } else {
        $details = null;
    }

    // 画像
    if(isset($_POST["formPostHImage"])) {
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png'
        ];

        $image = str_replace(" ", "+", $_POST["formPostHImage"]);
        $data = base64_decode($image);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $data);
        $mime = $extensions[$mimeType];
        $id = uniqid();
        $dir = "./image";
        $filename = $id.".".$mime;

        file_put_contents($dir."/".$filename, $data);
    } else {
        $filename = null;
    }

    try {
        $conn->beginTransaction();

        $sql = "INSERT INTO article(userID, workID, image, name, sAddress1, sAddress2, sAddress3, details, go, favorite, date) VALUES(".$userID.", ".$workID.", '".$filename."', '".$name."', '".$sAddress1."', '".$sAddress2."', '".$sAddress3."', '".$details."', 0, 0, '".$date."');";
        $conn->exec($sql);

        $sql = "SELECT LAST_INSERT_ID() AS id;";
        $aid = $conn->query($sql)->fetch()["id"];

        $conn->commit();

        header("Location:view.php?v=".$aid);
    } catch(Exception $e) {
        $conn->rollBack();
        die($e->getMessage());
    }
} else {
    header("Location:postArticle.php");
}
