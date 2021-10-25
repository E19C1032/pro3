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
    exit();
}

// 必須項目がPOSTまたはGETに存在するか？
if(isset($_GET["aid"]) && isset($_POST["formPostName"]) && isset($_POST["formPostWork"]) && isset($_POST["formPostWorkPseudonym"]) && isset($_POST["formPostWorkType"]) && isset($_POST["selectPrefecture"]) && isset($_POST["formPostMunicipality"]) && isset($_POST["formPostLast"])) {
    $articleID = $_GET["aid"];
    
    // 必須項目
    $name = $_POST["formPostName"];
    $work = $_POST["formPostWork"];
    $workPseudonym = $_POST["formPostWorkPseudonym"];
    $type = $_POST["formPostWorkType"];
    $sAddress1 = $_POST["selectPrefecture"];
    $sAddress2 = $_POST["formPostMunicipality"];
    $sAddress3 = $_POST["formPostLast"];
    $date = date("Y/m/d H:i:s");

    // 引き継ぐ記事の情報
    // iar: Inherit Article Result
    $sql = "
    SELECT image 
    FROM article 
    WHERE 
        articleID = ".$articleID.";";
    $iar = $conn->query($sql)->fetch();

    // 作品タイトルが存在しない場合、追加する
    $sql = "
    SELECT EXISTS (
        SELECT title 
        FROM work 
        WHERE 
            title = '".$work."' AND 
            type = " . $type . "
    ) 
    AS existsWork;";
    $existsWork = $conn->query($sql)->fetch()["existsWork"];
    if(!$existsWork) {
        $sql = "
        INSERT INTO work(title, titlePseudonym, type) 
        VALUES('".$work."', '".$workPseudonym."', " . $type . ");";
        $conn->exec($sql);
    }

    // 作品ID
    $sql = "
    SELECT workID 
    FROM work 
    WHERE 
        title = '".$work."';";
    $workID = $conn->query($sql)->fetch()["workID"];

    // 任意項目
    // 詳細
    if(isset($_POST["formPostDetails"]) && strlen($_POST["formPostDetails"]) > 0) {
        $details = $_POST["formPostDetails"];
    } else {
        $details = null;
    }

    // 画像
    if(isset($_POST["formPostHImage"])) {
        $base64 = str_replace(" ", "+", $_POST["formPostHImage"]);
        $data = base64_decode($base64);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $data);

        switch($mimeType) {
            case "image/jpeg":
                $mime = "jpg";
                break;
            
            case "image/png":
                $mime = "png";
                break;

            default:
                header("Location: repostArticle.php?aid=".$articleID."&err=0");
                exit();
        }

        $dir = "./image";
        $id = uniqid();
        $filename = $id.".".$mime;

    } else {
        $filename = null;
    }

    try {
        $conn->beginTransaction();

        $sql = "
        UPDATE article 
        SET 
            workID = ".$workID.", 
            image = '".$filename."', 
            name = '".$name."', 
            sAddress1 = '".$sAddress1."', 
            sAddress2 = '".$sAddress2."', 
            sAddress3 = '".$sAddress3."', 
            details = '".$details."', 
            date = '".$date."' 
        WHERE 
            articleID = ".$articleID.";";
        $conn->exec($sql);

        if($filename != null) {
            file_put_contents($dir."/".$filename, $data);
        }

        $conn->commit();

        // 画像があれば消す
        if(strlen($iar["image"]) > 0) {
            unlink($dir."/".$iar["image"]);
        }

        header("Location:view.php?v=" . $articleID);
        exit();
    } catch(Exception $e) {
        $conn->rollBack();
        header("Location: repostArticle.php?aid=" . $articleID);
        exit();
    }
} else {
    header("Location:repostArticle.php");
    exit();
}
