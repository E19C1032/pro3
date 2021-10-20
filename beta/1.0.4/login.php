<?php

require "php/include/readIni.php";

// ログインが失敗したかどうかをurlパラメータで判断
$loginFalse = false;
if (isset($_GET["login"])) {
    $loginFalse = true;
}



require "php/login.php";

?>
