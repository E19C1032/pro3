<?php

require "php/include/readIni.php";
require "php/include/pdoConnect.php";
require "php/include/util.php";

session_start();

$password = randomPassword();



require "php/resettingPassword.php";
