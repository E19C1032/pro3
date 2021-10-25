<?php

class KanaToRomaji{
    function convert($str)
    {
        $str = mb_convert_kana($str, 'cHV', 'utf-8');
 
        $kana = array(
            'きゃ', 'きぃ', 'きゅ', 'きぇ', 'きょ',
            'ぎゃ', 'ぎぃ', 'ぎゅ', 'ぎぇ', 'ぎょ',
            'くぁ', 'くぃ', 'くぅ', 'くぇ', 'くぉ',
            'ぐぁ', 'ぐぃ', 'ぐぅ', 'ぐぇ', 'ぐぉ',
            'しゃ', 'しぃ', 'しゅ', 'しぇ', 'しょ',
            'じゃ', 'じぃ', 'じゅ', 'じぇ', 'じょ',
            'ちゃ', 'ちぃ', 'ちゅ', 'ちぇ', 'ちょ',
            'ぢゃ', 'ぢぃ', 'ぢゅ', 'ぢぇ', 'ぢょ',
            'つぁ', 'つぃ', 'つぇ', 'つぉ',
            'てゃ', 'てぃ', 'てゅ', 'てぇ', 'てょ',
            'でゃ', 'でぃ', 'でぅ', 'でぇ', 'でょ',
            'とぁ', 'とぃ', 'とぅ', 'とぇ', 'とぉ',
            'にゃ', 'にぃ', 'にゅ', 'にぇ', 'にょ',
            'ヴぁ', 'ヴぃ', 'ヴぇ', 'ヴぉ',
            'ひゃ', 'ひぃ', 'ひゅ', 'ひぇ', 'ひょ',
            'ふぁ', 'ふぃ', 'ふぇ', 'ふぉ',
            'ふゃ', 'ふゅ', 'ふょ',
            'びゃ', 'びぃ', 'びゅ', 'びぇ', 'びょ',
            'ヴゃ', 'ヴぃ', 'ヴゅ', 'ヴぇ', 'ヴょ',   
            'ぴゃ', 'ぴぃ', 'ぴゅ', 'ぴぇ', 'ぴょ',
            'みゃ', 'みぃ', 'みゅ', 'みぇ', 'みょ',   
            'りゃ', 'りぃ', 'りゅ', 'りぇ', 'りょ',
            'うぃ', 'うぇ', 'いぇ'
        );
         
        $romaji  = array(
            'kya', 'kyi', 'kyu', 'kye', 'kyo',
            'gya', 'gyi', 'gyu', 'gye', 'gyo',
            'qwa', 'qwi', 'qwu', 'qwe', 'qwo',
            'gwa', 'gwi', 'gwu', 'gwe', 'gwo',
            'sya', 'syi', 'syu', 'sye', 'syo',
            'ja', 'jyi', 'ju', 'je', 'jo',
            'cha', 'cyi', 'chu', 'che', 'cho',
            'dya', 'dyi', 'dyu', 'dye', 'dyo',
            'tsa', 'tsi', 'tse', 'tso',
            'tha', 'ti', 'thu', 'the', 'tho',
            'dha', 'di', 'dhu', 'dhe', 'dho',
            'twa', 'twi', 'twu', 'twe', 'two',
            'nya', 'nyi', 'nyu', 'nye', 'nyo',
            'va', 'vi', 've', 'vo',
            'hya', 'hyi', 'hyu', 'hye', 'hyo',
            'fa', 'fi', 'fe', 'fo',
            'fya', 'fyu', 'fyo',
            'bya', 'byi', 'byu', 'bye', 'byo',
            'vya', 'vyi', 'vyu', 'vye', 'vyo',
            'pya', 'pyi', 'pyu', 'pye', 'pyo',
            'mya', 'myi', 'myu', 'mye', 'myo',
            'rya', 'ryi', 'ryu', 'rye', 'ryo',
            'wi', 'we', 'ye'
        );
         
        $str = $this->kana_replace($str, $kana, $romaji);
 
        $kana = array(
            'あ', 'い', 'う', 'え', 'お',
            'か', 'き', 'く', 'け', 'こ',
            'さ', 'し', 'す', 'せ', 'そ',
            'た', 'ち', 'つ', 'て', 'と',
            'な', 'に', 'ぬ', 'ね', 'の',
            'は', 'ひ', 'ふ', 'へ', 'ほ',
            'ま', 'み', 'む', 'め', 'も',
            'や', 'ゆ', 'よ',
            'ら', 'り', 'る', 'れ', 'ろ',
            'わ', 'ゐ', 'ゑ', 'を', 'ん',
            'が', 'ぎ', 'ぐ', 'げ', 'ご',
            'ざ', 'じ', 'ず', 'ぜ', 'ぞ',
            'だ', 'ぢ', 'づ', 'で', 'ど',
            'ば', 'び', 'ぶ', 'べ', 'ぼ',
            'ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ'
        );
         
        $romaji = array(
            'a', 'i', 'u', 'e', 'o',
            'ka', 'ki', 'ku', 'ke', 'ko',
            'sa', 'shi', 'su', 'se', 'so',
            'ta', 'chi', 'tsu', 'te', 'to',
            'na', 'ni', 'nu', 'ne', 'no',
            'ha', 'hi', 'fu', 'he', 'ho',
            'ma', 'mi', 'mu', 'me', 'mo',
            'ya', 'yu', 'yo',
            'ra', 'ri', 'ru', 're', 'ro',
            'wa', 'wyi', 'wye', 'wo', 'n',
            'ga', 'gi', 'gu', 'ge', 'go',
            'za', 'ji', 'zu', 'ze', 'zo',
            'da', 'ji', 'du', 'de', 'do',
            'ba', 'bi', 'bu', 'be', 'bo',
            'pa', 'pi', 'pu', 'pe', 'po'
        );
         
        $str = $this->kana_replace($str, $kana, $romaji);
         
        $str = preg_replace('/(っ$|っ[^a-z])/u', "xtu", $str);
        $res = preg_match_all('/(っ)(.)/u', $str, $matches);
        if(!empty($res)){
            for($i=0;isset($matches[0][$i]);$i++){
                if($matches[0][$i] == 'っc') $matches[2][$i] = 't';
                $str = preg_replace('/' . $matches[1][$i] . '/u', $matches[2][$i], $str, 1);
            }
        }
         
        $kana = array(
            'ぁ', 'ぃ', 'ぅ', 'ぇ', 'ぉ',
            'ヵ', 'ヶ', 'っ', 'ゃ', 'ゅ', 'ょ', 'ゎ', '、', '。', '　'
        );
         
        $romaji = array(
            'a', 'i', 'u', 'e', 'o',
            'ka', 'ke', 'xtu', 'xya', 'xyu', 'xyo', 'xwa', ', ', '.', ' '
        );
        $str = $this->kana_replace($str, $kana, $romaji);
         
        $str = preg_replace('/^ー|[^a-z]ー/u', '', $str);
        $res = preg_match_all('/(.)(ー)/u', $str, $matches);
 
        if($res){
            for($i=0;isset($matches[0][$i]);$i++){
                if( $matches[1][$i] == "a" ){ $replace = 'â'; }
                else if( $matches[1][$i] == "i" ){ $replace = 'î'; }
                else if( $matches[1][$i] == "u" ){ $replace = 'û'; }
                else if( $matches[1][$i] == "e" ){ $replace = 'ê'; }
                else if( $matches[1][$i] == "o" ){ $replace = 'ô'; }
                else { $replace = ""; }
                 
                $str = preg_replace('/' . $matches[0][$i] . '/u', $replace, $str, 1);
            }
        }
         
        return $str;
    }
 
    function kana_replace($str, $kana, $romaji)
    {
        $patterns = array();
        foreach($kana as $value){
            $patterns[] = '/' . $value . '/';
        }
         
        $str = preg_replace($patterns, $romaji, $str);
        return $str;
    }
}

/**
 * 全角かな・カナの濁点を除去する。
 * 
 * @param string $zenkakuHiragana
 * @return string 
 */
function removeDakuten($zenkakuHiragana) {
    $encode = "utf-8";

    // 全角ひらがなを半角カタカナに変換
    $hankakuKatakana = mb_convert_kana($zenkakuHiragana, "h", $encode);

    // 半角カタカナを全角ひらがなに変換する
    // 濁点が含まれる場合は1つの文字として変換される
    $zenkakuHiragana = mb_convert_kana($hankakuKatakana, "H", $encode);

    if (mb_strlen($zenkakuHiragana, $encode) > 1) {
        // 濁点を除いた文字列を取得する
        $zenkakuHiragana = mb_substr($zenkakuHiragana, 0, 1, $encode);
    }

    return $zenkakuHiragana;
}

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

/**
 * sqlを実行する。
 * 
 * @param PDO $conn 
 * @param string $sql 
 * @param array $par 
 */
function execsql($conn, $sql, $par = null) {
    try {
        $prepare = $conn->prepare($sql);
        if($par != null) {
            for($i = 0; $i < count($par); $i++) {
                $prepare->bindParam($i + 1, $par[$i]);
            }
        }
        $prepare->execute();

        return $prepare;
    } catch(Exception $e) {

    }
}
