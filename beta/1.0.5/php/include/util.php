<?php

/**
 * URLが画像である場合はBase64エンコードしたものを返す。
 * URLが画像でない場合はfalseを返す。
 * 
 * @param string $src
 * @return string|bool
 */
function readImageToBase64($url) {
    $eUrl = explode("/", $url);
    if(strlen($eUrl[count($eUrl) - 1]) == 0 || !exif_imagetype($url)) return false;

    $image = file_get_contents($url);
    $encImage = base64_encode($image);
    $imginfo = getimagesize("data:application/octet-stream;base64,".$encImage);
    return "data:".$imginfo["mime"].";base64,".$encImage;
}

/**
 * URLが画像である場合は画像の横幅を返す。
 * URLが画像でない場合はfalseを返す。
 * 
 * @param string $src
 * @return int|bool
 */
function getImageWidth($url) {
    if(strlen(explode("/", $url)[2]) == 0 || !exif_imagetype($url)) return false;

    return getimagesize($url)[0];
}

/**
 * URLが画像である場合は画像の縦幅を返す。
 * URLが画像でない場合はfalseを返す。
 * 
 * @param string $src
 * @return int|bool
 */
function getImageHeight($url) {
    if(strlen(explode("/", $url)[2]) == 0 || !exif_imagetype($url)) return false;

    return getimagesize($url)[1];
}

/**
 * URLのGETパラメータを変更する。
 * 
 * @param array $par
 * @param int $op
 */
function url_param_change($par=Array(),$op=0){
    $url = parse_url($_SERVER["REQUEST_URI"]);
    if(isset($url["query"])) parse_str($url["query"],$query);
    else $query = Array();
    foreach($par as $key => $value){
        if($key && is_null($value)) unset($query[$key]);
        else $query[$key] = $value;
    }
    $query = str_replace("=&", "&", http_build_query($query));
    $query = preg_replace("/=$/", "", $query);
    return $query ? (!$op ? "?" : "").htmlspecialchars($query, ENT_QUOTES) : "";
}