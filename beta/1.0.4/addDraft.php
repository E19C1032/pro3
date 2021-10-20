<?php

require "php/include/pdoConnect.php";

session_start();

// ログインしているかどうか
$login = false;
if (isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

if(isset($_POST["name"]) && isset($_POST["title"]) && isset($_POST["titlePseudonym"]) && isset($_POST["prefecture"]) && isset($_POST["municipality"]) && isset($_POST["last"]) && isset($_POST["details"]) && isset($_POST["image"])) {
    $name = $_POST["name"];
    $title = $_POST["title"];
    $titlePseudonym = $_POST["titlePseudonym"];
    $prefecture = $_POST["prefecture"];
    $municipality = $_POST["municipality"];
    $last = $_POST["last"];
    $details = $_POST["details"];
    $image = $_POST["image"];
    $image = str_replace(" ", "+", $image);

    try {
        if(strlen($image) > 0) {
            $extensions = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png'
            ];
    
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

        $conn->beginTransaction();

        $sql = "INSERT INTO draft(userID, title, titlePseudonym, image, name, sAddress1, sAddress2, sAddress3, details) VALUES(".$userID.", '".$title."', '".$titlePseudonym."', '".$filename."', '".$name."', '".$prefecture."', '".$municipality."', '".$last."', '".$details."');";
        $conn->exec($sql);

        $conn->commit();
    } catch(Exception $e) {
        $conn->rollBack();
        $array = array("c" => false, "ex" => $e->getMessage());
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
    }

    $array = array("c" => true);
} else {
    $array = array("c" => false);
}

header("Content-Type: text/javascript; charset=utf-8");
echo(json_encode($array));
