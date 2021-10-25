<?php

require "php/include/readIni.php";

// 利用規約ファイル読み込み
$termsOfUse = file_get_contents("./wp_contents/terms_of_use.txt");



require "php/createAccount.php";
