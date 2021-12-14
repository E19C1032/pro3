<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "\"" . mb_substr($keyword, 1, mb_strlen($keyword) - 2) . "\" の" ?>検索結果 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202112141602">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/search.js?202112141602"></script>
    <script src="js/search-css.js?202112141602"></script>

    <style>
    div.disable {
        display: none;
    }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <h1>SEITI</h1>
                </a>
                <div class="button">
                    <input type="radio" name="genre" id="genre-anime" value="1" checked="checked">
                    <label for="genre-anime">アニメ</label>
                    <input type="radio" name="genre" id="genre-drama" value="2">
                    <label for="genre-drama">ドラマ</label>
                    <input type="radio" name="genre" id="genre-game" value="3">
                    <label for="genre-game">ゲーム</label>
                    <div>
                        <ul id="tab">
                            <li class="active">あ</li>
                            <li>A</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <?php if ($login) { ?>

                    <!-- ログイン時のメニュー -->
                    <ul>
                        <a href="postArticle.php">
                            <li>投稿</li>
                        </a>
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>
                    </ul>
                </div>
                <div>
                    <a href="logout.php">
                        ログアウト
                    </a>
                </div>

                <!-- 未ログイン時 -->
                <?php } else { ?>
                <ul>
                    <a href="createAccount.php">
                        <li>新規登録</li>
                    </a>
                </ul>
        </div>
        <div>
            <a href="login.php">
                ログイン
            </a>
        </div>
        <?php } ?>
        </header>
    </div>

    <div id="container">
        <main>
            <div id="main-container">


                <div id="container-search">
                    <div id="main">
                        <div class="search-button">
                            <div class="search-button-kana tab-item active">
                                <div class="search-button-kana-top">
                                    <ul id="kana-tab">
                                        <li class="kana-active">あ</li>
                                        <li>か</li>
                                        <li>さ</li>
                                        <li>た</li>
                                        <li>な</li>
                                        <li>は</li>
                                        <li>ま</li>
                                        <li>や</li>
                                        <li>ら</li>
                                        <li>わ</li>
                                    </ul>
                                </div>
                                <div class="search-button-kana-bottom">
                                    <ul class="kana-tab-item kana-active">
                                        <li><a href="#title-head-kana-a">あ</a></li>
                                        <li><a href="#title-head-kana-i">い</a></li>
                                        <li><a href="#title-head-kana-u">う</a></li>
                                        <li><a href="#title-head-kana-e">え</a></li>
                                        <li><a href="#title-head-kana-o">お</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-ka">か</a></li>
                                        <li><a href="#title-head-kana-ki">き</a></li>
                                        <li><a href="#title-head-kana-ku">く</a></li>
                                        <li><a href="#title-head-kana-ke">け</a></li>
                                        <li><a href="#title-head-kana-ko">こ</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-sa">さ</a></li>
                                        <li><a href="#title-head-kana-shi">し</a></li>
                                        <li><a href="#title-head-kana-su">す</a></li>
                                        <li><a href="#title-head-kana-se">せ</a></li>
                                        <li><a href="#title-head-kana-so">そ</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-ta">た</a></li>
                                        <li><a href="#title-head-kana-ti">ち</a></li>
                                        <li><a href="#title-head-kana-tu">つ</a></li>
                                        <li><a href="#title-head-kana-te">て</a></li>
                                        <li><a href="#title-head-kana-to">と</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-na">な</a></li>
                                        <li><a href="#title-head-kana-ni">に</a></li>
                                        <li><a href="#title-head-kana-nu">ぬ</a></li>
                                        <li><a href="#title-head-kana-ne">ね</a></li>
                                        <li><a href="#title-head-kana-no">の</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-ha">は</a></li>
                                        <li><a href="#title-head-kana-hi">ひ</a></li>
                                        <li><a href="#title-head-kana-fu">ふ</a></li>
                                        <li><a href="#title-head-kana-he">へ</a></li>
                                        <li><a href="#title-head-kana-ho">ほ</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-ma">ま</a></li>
                                        <li><a href="#title-head-kana-mi">み</a></li>
                                        <li><a href="#title-head-kana-mu">む</a></li>
                                        <li><a href="#title-head-kana-me">め</a></li>
                                        <li><a href="#title-head-kana-mo">も</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-ya">や</a></li>
                                        <li><a href="#title-head-kana-yu">ゆ</a></li>
                                        <li><a href="#title-head-kana-yo">よ</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-ra">ら</a></li>
                                        <li><a href="#title-head-kana-ri">り</a></li>
                                        <li><a href="#title-head-kana-ru">る</a></li>
                                        <li><a href="#title-head-kana-re">れ</a></li>
                                        <li><a href="#title-head-kana-ro">ろ</a></li>
                                    </ul>
                                    <ul class="kana-tab-item">
                                        <li><a href="#title-head-kana-wa">わ</a></li>
                                        <li><a href="#title-head-kana-wyi">ゐ</a></li>
                                        <li><a href="#title-head-kana-wye">ゑ</a></li>
                                        <li><a href="#title-head-kana-wo">を</a></li>
                                        <li><a href="#title-head-kana-n">ん</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="search-button-alphabet tab-item">
                                <div class="search-button-alphabet-top">
                                    <ul>
                                        <li><a href="#title-head-A">A</a></li>
                                        <li><a href="#title-head-B">B</a></li>
                                        <li><a href="#title-head-C">C</a></li>
                                        <li><a href="#title-head-D">D</a></li>
                                        <li><a href="#title-head-E">E</a></li>
                                        <li><a href="#title-head-F">F</a></li>
                                        <li><a href="#title-head-G">G</a></li>
                                        <li><a href="#title-head-H">H</a></li>
                                        <li><a href="#title-head-I">I</a></li>
                                        <li><a href="#title-head-J">J</a></li>
                                        <li><a href="#title-head-K">K</a></li>
                                        <li><a href="#title-head-L">L</a></li>
                                        <li><a href="#title-head-M">M</a></li>
                                    </ul>
                                </div>
                                <div class="search-button-alphabet-buttom">
                                    <ul>
                                        <li><a href="#title-head-N">N</a></li>
                                        <li><a href="#title-head-O">O</a></li>
                                        <li><a href="#title-head-P">P</a></li>
                                        <li><a href="#title-head-Q">Q</a></li>
                                        <li><a href="#title-head-R">R</a></li>
                                        <li><a href="#title-head-S">S</a></li>
                                        <li><a href="#title-head-T">T</a></li>
                                        <li><a href="#title-head-U">U</a></li>
                                        <li><a href="#title-head-V">V</a></li>
                                        <li><a href="#title-head-W">W</a></li>
                                        <li><a href="#title-head-X">X</a></li>
                                        <li><a href="#title-head-Y">Y</a></li>
                                        <li><a href="#title-head-Z">Z</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php

                            if(count($wrArray) > 0) {

                                for ($i = 0; $i < count($wrArray); $i++) {
                                    $keys = array_keys($wrArray);

                                ?>

                        <h3 id="title-head-<?php

                                                        if (preg_match("/^[a-zA-Z]/u", $keys[$i])) {
                                                            echo $keys[$i];
                                                        } else {
                                                            $k2r = new KanaToRomaji;
                                                            $romaji = $k2r->convert($keys[$i]);
                                                            echo "kana-" . $romaji;
                                                        }

                                                        ?>" class="title-head"><?php echo $keys[$i] ?></h3>

                        <?php

                                    for ($j = 1; $j < count($wrArray[$keys[$i]]); $j++) {
                                        $workID = $wrArray[$keys[$i]][$j]["workID"];
                                        $title = $wrArray[$keys[$i]][$j]["title"];
                                        $titlePseudonym = $wrArray[$keys[$i]][$j]["titlePseudonym"];
                                        $type = $wrArray[$keys[$i]][$j]["type"];

                                        ?>
                        <div>
                            <a href="article.php?wid=<?php echo $workID ?>" class="title"
                                data-type="<?php echo $type ?>"><ruby><?php echo $title . "<rt>" . $titlePseudonym . "</rt></ruby><p>" . $typeStr[$type] . "</p>" ?></a>
                        </div>

                        <?php

                                    }
                                }
                            } else {

                            ?>

                        <h3>タイトルが見つかりませんでした。</h3>

                        <?php } ?>

                    </div>
                    <div id="aside">
                        <div class="search-aside">
                            <input type="text" id="input-search" placeholder="タイトル検索">
                        </div>
                        <div id="pr">
                            <h2>人気タイトル</h2>
                            <ul>
                                <?php

                                    for ($i = 0; $i < count($pr); $i++) {
                                        $sql = "
                                            SELECT workID, title, titlePseudonym, type 
                                            FROM work 
                                            WHERE 
                                                workID = ?;
                                        ";
                                        $result = execsql($conn, $sql, array($pr[$i]["workID"]))->fetch();

                                        ?>

                                <li>
                                    <div><?php echo $i+1 ?></div>
                                    <a href="article.php?wid=<?php echo $result["workID"] ?>"
                                        data-type="<?php echo $result["type"] ?>">
                                        <ruby><?php echo $result["title"] . "<rt>" . $result["titlePseudonym"] . "</rt></ruby>"?>
                                    </a>
                                    <p><?php echo $typeStr[$result["type"]] ?></p>
                                </li>

                                <?php } ?>
                            </ul>

                        </div>
                        <div id="lr">
                            <h2>最新記事</h2>
                            <ul>
                                <?php 
                                
                                for ($i = 0; $i < count($lr); $i++) { 
                                    if($lr[$i]["image"] == null) {
                                        $filename = "image/noimage.png";
                                    } else {
                                        $filename = "image/" . $lr[$i]["image"];
                                    }

                                    $imgSrc = readImageToBase64($filename);
                                    
                                ?>

                                <li>
                                    <a href="view.php?v=<?php echo $lr[$i]["articleID"] ?>">
                                        <image src="<?php echo $imgSrc ?>">
                                        <div>
                                            <p><?php echo $lr[$i]["date"] ?></p>
                                            <p><?php echo $lr[$i]["name"] ?></p>
                                        </div>
                                    </a>
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
                                    $sql = "SELECT articleID, image, name, date FROM article WHERE articleID = " . $fr[$i]["articleID"] . ";";
                                    $result = $conn->query($sql)->fetch();

                                    if($result["image"] == null) {
                                        $filename = "image/noimage.png";
                                    } else {
                                        $filename = "image/" . $result["image"];
                                    }

                                    $imgSrc = readImageToBase64($filename);

                                ?>

                                <li>
                                    <a href="view.php?v=<?php echo $result["articleID"] ?>">
                                        <image src="<?php echo $imgSrc ?>">
                                        <div>
                                            <p><?php echo $result["date"] ?></p>
                                            <p><?php echo $result["name"] ?></p>
                                        </div>
                                    </a>
                                </li>

                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div id="footer-top">
                <div>
                    <h3>SEITI</h3>
                </div>
                <div>

                </div>
            </div>
            <div id="footer-bottom">
                <p>©　2021 SEITI　</p>
                [<div id="version"><?php echo $ini["version"] ?>]</div>
            </div>
        </footer>
    </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>