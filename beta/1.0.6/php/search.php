<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "\"" . $keyword . "\" の" ?>検索結果 - SEITI</title>

    <link rel="stylesheet" href="css/search.css??202110230058">

    <script src="js/search.js?202110230056"></script>
</head>

<body>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="top.php">
                    <h1>SEITI</h1>
                </a>

                <div>
                    <h3>ジャンル</h3>

                    <input type="radio" name="genre" id="genre-anime" value="1">
                    <label for="genre-anime">アニメ</label><br>
                    <input type="radio" name="genre" id="genre-drama" value="2">
                    <label for="genre-drama">ドラマ</label><br>
                    <input type="radio" name="genre" id="genre-game" value="3">
                    <label for="genre-game">ゲーム</label><br>

                    <h3>作品名</h3>

                    <details>
                        <summary>あ行</summary>
                        <a href="#title-head-kana-a">あ</a>
                        <a href="#title-head-kana-i">い</a>
                        <a href="#title-head-kana-u">う</a>
                        <a href="#title-head-kana-e">え</a>
                        <a href="#title-head-kana-o">お</a>
                    </details>
                    <details>
                        <summary>か行</summary>
                        <a href="#title-head-kana-ka">か</a>
                        <a href="#title-head-kana-ki">き</a>
                        <a href="#title-head-kana-ku">く</a>
                        <a href="#title-head-kana-ke">け</a>
                        <a href="#title-head-kana-ko">こ</a>
                    </details>
                    <details>
                        <summary>さ行</summary>
                        <a href="#title-head-kana-sa">さ</a>
                        <a href="#title-head-kana-shi">し</a>
                        <a href="#title-head-kana-su">す</a>
                        <a href="#title-head-kana-se">せ</a>
                        <a href="#title-head-kana-so">そ</a>
                    </details>
                    <details>
                        <summary>た行</summary>
                        <a href="#title-head-kana-ta">た</a>
                        <a href="#title-head-kana-chi">ち</a>
                        <a href="#title-head-kana-tsu">つ</a>
                        <a href="#title-head-kana-te">て</a>
                        <a href="#title-head-kana-to">と</a>
                    </details>
                    <details>
                        <summary>な行</summary>
                        <a href="#title-head-kana-na">な</a>
                        <a href="#title-head-kana-ni">に</a>
                        <a href="#title-head-kana-nu">ぬ</a>
                        <a href="#title-head-kana-ne">ね</a>
                        <a href="#title-head-kana-no">の</a>
                    </details>
                    <details>
                        <summary>は行</summary>
                        <a href="#title-head-kana-ha">は</a>
                        <a href="#title-head-kana-hi">ひ</a>
                        <a href="#title-head-kana-fu">ふ</a>
                        <a href="#title-head-kana-he">へ</a>
                        <a href="#title-head-kana-ho">ほ</a>
                    </details>
                    <details>
                        <summary>ま行</summary>
                        <a href="#title-head-kana-ma">ま</a>
                        <a href="#title-head-kana-mi">み</a>
                        <a href="#title-head-kana-mu">む</a>
                        <a href="#title-head-kana-me">め</a>
                        <a href="#title-head-kana-mo">も</a>
                    </details>
                    <details>
                        <summary>や行</summary>
                        <a href="#title-head-kana-ya">や</a>
                        <a href="#title-head-kana-yu">ゆ</a>
                        <a href="#title-head-kana-yo">よ</a>
                    </details>
                    <details>
                        <summary>ら行</summary>
                        <a href="#title-head-kana-ra">ら</a>
                        <a href="#title-head-kana-ri">り</a>
                        <a href="#title-head-kana-ru">る</a>
                        <a href="#title-head-kana-re">れ</a>
                        <a href="#title-head-kana-ro">ろ</a>
                    </details>
                    <details>
                        <summary>わ行</summary>
                        <a href="#title-head-kana-wa">わ</a>
                        <a href="#title-head-kana-wyi">ゐ</a>
                        <a href="#title-head-kana-wye">ゑ</a>
                        <a href="#title-head-kana-wo">を</a>
                        <a href="#title-head-kana-n">ん</a>
                    </details>
                    <details>
                        <summary>A-E</summary>
                        <a href="#title-head-A">A</a>
                        <a href="#title-head-B">B</a>
                        <a href="#title-head-C">C</a>
                        <a href="#title-head-D">D</a>
                        <a href="#title-head-E">E</a>
                    </details>
                    <details>
                        <summary>F-J</summary>
                        <a href="#title-head-F">F</a>
                        <a href="#title-head-G">G</a>
                        <a href="#title-head-H">H</a>
                        <a href="#title-head-I">I</a>
                        <a href="#title-head-J">J</a>
                    </details>
                    <details>
                        <summary>K-O</summary>
                        <a href="#title-head-K">K</a>
                        <a href="#title-head-L">L</a>
                        <a href="#title-head-M">M</a>
                        <a href="#title-head-N">N</a>
                        <a href="#title-head-O">O</a>
                    </details>
                    <details>
                        <summary>P-T</summary>
                        <a href="#title-head-P">P</a>
                        <a href="#title-head-Q">Q</a>
                        <a href="#title-head-R">R</a>
                        <a href="#title-head-S">S</a>
                        <a href="#title-head-T">T</a>
                    </details>
                    <details>
                        <summary>U-Z</summary>
                        <a href="#title-head-U">U</a>
                        <a href="#title-head-V">V</a>
                        <a href="#title-head-W">W</a>
                        <a href="#title-head-X">X</a>
                        <a href="#title-head-Y">Y</a>
                        <a href="#title-head-Z">Z</a>
                    </details>

                    <ul>
                        <?php if ($login) { ?>

                        <!-- ログイン時のメニュー -->
                        <a href="postArticle.php">
                            <li>投稿</li>
                        </a>
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>


                        <?php } else { ?>
                        <a href="createAccount.php">
                            <li>新規登録</li>
                        </a>
                        <a href="login.php">
                            <li>ログイン</li>
                        </a>

                        <?php } ?>
                    </ul>
                </div>
            </header>
        </div>

        <div id="container">
            <div id="main">

                <input type="text" id="input-search"><br>

                <?php

                for ($i = 0; $i < count($wrArray); $i++) {
                    $keys = array_keys($wrArray);

                ?>

                <h3 id="title-head-<?php
                
                if(preg_match("/^[a-zA-Z]/u", $keys[$i])) {
                    echo $keys[$i];
                } else {
                    $k2r = new KanaToRomaji;
                    $romaji = $k2r->convert($keys[$i]);
                    echo "kana-" . $romaji;
                }

                ?>"><?php echo $keys[$i] ?></h3>

                <?php

                    for ($j = 1; $j < count($wrArray[$keys[$i]]); $j++) {
                        $workID = $wrArray[$keys[$i]][$j]["workID"];
                        $title = $wrArray[$keys[$i]][$j]["title"];
                        $titlePseudonym = $wrArray[$keys[$i]][$j]["titlePseudonym"];
                        $type = $wrArray[$keys[$i]][$j]["type"];

                ?>

                <a href="article.php?wid=<?php echo $workID ?>" class="title" data-type="<?php echo $type ?>"><?php echo $title . "（" . $titlePseudonym . "）" ?></a><br>

                <?php

                    }
                }

                ?>

            </div>
            <div id="aside">
                <div id="pr">
                    <h2>人気タイトル</h2>
                    <ol>
                        <?php

                        for ($i = 0; $i < count($pr); $i++) {
                            $sql = "SELECT workID, title, titlePseudonym FROM work WHERE workID = " . $pr[$i]["workID"] . ";";
                            $result = $conn->query($sql)->fetch();

                        ?>

                        <li>
                            <a href="article.php?wid=<?php echo $result["workID"] ?>"><?php echo $result["title"] . "（" . $result["titlePseudonym"] . "）" ?></a>
                        </li>

                        <?php } ?>
                    </ol>

                </div>
                <div id="lr">
                    <h2>最新記事</h2>
                    <ul>
                        <?php for ($i = 0; $i < count($lr); $i++) { ?>

                        <li>
                            <a href="view.php?v=<?php echo $lr[$i]["articleID"] ?>"><?php echo $lr[$i]["name"] ?></a>
                        </li>

                        <?php } ?>
                    </ul>
                </div>
                <?php if ($login) { ?>
                <div id="fr">
                    <h2>お気に入り記事</h2>
                    <ul>
                        <?php

                        for ($i = 0; $i < count($fr); $i++) {
                            $sql = "SELECT articleID, name FROM article WHERE articleID = " . $fr[$i]["articleID"] . ";";
                            $result = $conn->query($sql)->fetch();

                        ?>

                        <li>
                            <a href="view.php?v=<?php echo $result["articleID"] ?>"><?php echo $result["name"] ?></a>
                        </li>

                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>