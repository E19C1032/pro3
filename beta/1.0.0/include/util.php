<?php

/**
 * URLが画像である場合はBase64エンコードしたものを返す。
 * URLが画像でない場合はfalseを返す。
 * 
 * @param string $src
 * @return string|bool
 */
function readImageToBase64($url) {
    if(strlen(explode("/", $url)[2]) == 0 || !exif_imagetype($url)) return false;

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
