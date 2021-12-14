<?php

require "php/include/pdoConnect.php";



if(isset($_GET["aid"])) {
    $id = $_GET["aid"];

    $prepare = $conn->prepare("
        SELECT * 
        FROM article 
        WHERE 
            articleID = :id;");
    $prepare->bindValue(":id", $id, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetch();

    $array = array("result" => $result);
    header("Content-Type: text/javascript; charset=utf-8");
    echo(json_encode($array));
    exit();
}

if(isset($_GET["uid"])) {
    try {
        $id = $_GET["uid"];

        $sortSql = "";
        $sort = "";
        $order = "ASC";
        if(isset($_GET["sort"])) {
            switch(strtoupper($_GET["sort"])) {
                case "ARTICLEID": break;
                case "USERID": break;
                case "WORKID": break;
                case "IMAGE": break;
                case "NAME": break;
                case "SADDRESS1": break;
                case "SADDRESS2": break;
                case "SADDRESS3": break;
                case "DETAILS": break;
                case "GO": break;
                case "FAVORITE": break;
                case "DATE": break;
                default: throw new Exception("sort: " . $_GET["sort"] . " は不正な値です。");
            }

            if(isset($_GET["order"])) {
                switch(strtoupper($_GET["order"])) {
                    case "ASC": 
                        $order = $_GET["order"];
                        break;
                    case "DESC": 
                        $order = $_GET["order"];
                        break;
                    default: throw new Exception("order: " . $_GET["order"] . "は不正な値です。");
                }
            }

            $sort = $_GET["sort"];

            $sortSql = "ORDER BY " . $sort . " " . $order;
        }

        $prepare = $conn->prepare("
            SELECT * 
            FROM article 
            WHERE 
                userID = :id 
            " . $sortSql . ";");
        $prepare->bindValue(":id", $id, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetchAll();

        $array = array("c" => true, "msg" => "成功", "result" => $result);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    } catch(Exception $e) {
        $array = array("c" => false, "msg" => $e->getMessage(), "result" => null);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
}

if(isset($_GET["wid"])) {
    try {
        $id = $_GET["wid"];

        $sortSql = "";
        $sort = "";
        $order = "ASC";
        if(isset($_GET["sort"])) {
            switch(strtoupper($_GET["sort"])) {
                case "ARTICLEID": break;
                case "USERID": break;
                case "WORKID": break;
                case "IMAGE": break;
                case "NAME": break;
                case "SADDRESS1": break;
                case "SADDRESS2": break;
                case "SADDRESS3": break;
                case "DETAILS": break;
                case "GO": break;
                case "FAVORITE": break;
                case "DATE": break;
                default: throw new Exception("sort: " . $_GET["sort"] . " は不正な値です。");
            }

            if(isset($_GET["order"])) {
                switch(strtoupper($_GET["order"])) {
                    case "ASC": 
                        $order = $_GET["order"];
                        break;
                    case "DESC": 
                        $order = $_GET["order"];
                        break;
                    default: throw new Exception("order: " . $_GET["order"] . "は不正な値です。");
                }
            }

            $sort = $_GET["sort"];

            $sortSql = "ORDER BY " . $sort . " " . $order;
        }

        $prepare = $conn->prepare("
            SELECT * 
            FROM article 
            WHERE 
                workID = :id 
            " . $sortSql . ";");
        $prepare->bindValue(":id", $id, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetchAll();

        $array = array("c" => true, "msg" => "成功", "result" => $result);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    } catch(Exception $e) {
        $array = array("c" => false, "msg" => $e->getMessage(), "result" => null);
        header("Content-Type: text/javascript; charset=utf-8");
        echo(json_encode($array));
        exit();
    }
}
