<?php

require "include/pdoConnect.php";

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

// 必須項目がPOSTまたはGETに存在するか？
if(isset($_GET["aid"]) && isset($_POST["formPostName"]) && isset($_POST["formPostWork"]) && isset($_POST["selectPrefecture"]) && isset($_POST["formPostMunicipality"]) && isset($_POST["formPostLast"])) {
    $articleID = $_GET["aid"];
    
    // 必須項目
    $name = $_POST["formPostName"];
    $work = $_POST["formPostWork"];
    $sAddress1 = $_POST["selectPrefecture"];
    $sAddress2 = $_POST["formPostMunicipality"];
    $sAddress3 = $_POST["formPostLast"];
    $date = date("Y/m/d H:i:s");

    // 引き継ぐ記事の情報
    // iar: Inherit Article Result
    $sql = "SELECT image, go, favorite FROM article WHERE articleID = ".$articleID.";";
    $iar = $conn->query($sql)->fetch();

    // 作品ID
    $sql = "SELECT workID FROM work WHERE title = '".$work."';";
    $workID = $conn->query($sql)->fetch()["workID"];

    // 任意項目
    if(isset($_POST["formPostDetails"]) && strlen($_POST["formPostDetails"]) > 0) {
        $details = $_POST["formPostDetails"];
    } else {
        $details = null;
    }

    if(isset($_FILES["formPostImage"]) && strlen($_FILES["formPostImage"]["name"]) > 0) {
        $image = $_FILES["formPostImage"];
        $tempfile = $_FILES["formPostImage"]["tmp_name"];

        $mime = explode("/", getimagesize($tempfile)["mime"])[1];
        $dir = "./image";
        $filename = $iar["image"];
    } else {
        $filename = null;
    }

    try {
        $conn->beginTransaction();

        $sql = "UPDATE article SET userID = $userID, workID = $workID, image = '".$filename."', name = '".$name."', sAddress1 = '".$sAddress1."', sAddress2 = '".$sAddress2."', sAddress3 = '".$sAddress3."', details = '".$details."', go = ".$iar["go"].", favorite = ".$iar["favorite"].", date = '".$date."' WHERE articleID = ".$articleID.";";
        $conn->exec($sql);

        if($filename != null) {
            if(is_uploaded_file($tempfile)) {
                if(move_uploaded_file($tempfile, $dir."/".$filename)) {
                    echo($filename."をアップロードしました。");
                } else {
                    echo("アップロードに失敗しました。");
                    throw new Exception("例外");
                }
            } else {
                echo("ファイルが選択されていません。");
                throw new Exception("例外");
            }
        }

        $conn->commit();

        header("Location:view.php?v=".$articleID);
    } catch(Exception $e) {
        $conn->rollBack();
        die($e->getMessage());
    }
} else {
    header("Location:repostArticle.php");
}
