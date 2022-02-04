<?php

$conn = null;
try{
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $conn = new PDO("mysql:host=mysql154.phy.lolipop.lan;dbname=LAA1364764-pro3;charset=utf8;", "LAA1364764", "UrVcXdC5zQJP", $option);
}catch(PDOException $e){
    die($e->getMessage());
}