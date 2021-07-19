<?php

$conn = null;
try{
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $conn = new PDO("mysql:host=127.0.0.1;dbname=test;charset=utf8;", "root", "7VK/=*TK+p-=>A%gSX6/YiDKSc=}3/k4", $option);
}catch(PDOException $e){
    die($e->getMessage());
}
