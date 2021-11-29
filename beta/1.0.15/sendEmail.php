<?php

require "php/include/readIni.php";
require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

if(isset($_POST["emailAddress"]) && isset($_POST["emailSubject"]) && isset($_POST["emailBody"])) {
    $to = $_POST["emailAddress"];
    $subject = $_POST["emailSubject"];
    $body = $_POST["emailBody"];

    if(isset($_POST["password"])) {
        try {
            $conn->beginTransaction();

            $sql = "
                UPDATE user 
                SET password = ?
                WHERE 
                    mailAddress = ?;
            ";
            execsql($conn, $sql, array($_POST["password"], $to));

            $conn->commit();
        } catch(Exception $e) {
            $conn->rollBack();
        }
    }

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");
    mb_send_mail($to, $subject, $body, "From: info@seiti.pepper.jp");
}
