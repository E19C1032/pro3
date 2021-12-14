<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>トップ - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202112141602">

    <script>
    const mapData = [
        <?php for($i = 0; $i < count($lar); $i++) { ?>

        {

            address: "<?php echo $lar[$i]["sAddress1"] . $lar[$i]["sAddress2"] . $lar[$i]["sAddress3"] ?>",
            title: "<?php echo $lar[$i]["name"] ?>",
            comment: "<?php echo str_replace(array("\r\n","\r", "\n"), "\\n", $lar[$i]["details"]) ?>",
            url: "view.php?v=<?php echo $lar[$i]["articleID"] ?>",
            zoom: 5

        },

        <?php } ?>
    ];
    </script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyD1IppMdLlsPjuGuUGZWQviMmc2brYPARo&language=ja"></script>
    <script src="js/top.js?202112141602"></script>
</head>

<body>
    <div class="popup-index">
        <div class="content">
            <h2>ご協力お願いします</h2>
            <div class="content-image">
                <img src="wp_contents/image/image01.svg" alt="">
                <img src="wp_contents/image/image02.svg" alt="">
            </div>
            <p>ゴミをポイ捨てせずに持ち帰り、<br>みんなで聖地を守りましょう。</p>
            <div class="content-button">
                <button id="close">了解しました</button>
            </div>
        </div>
    </div>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <h1>SEITI</h1>
                </a>

                <?php if ($login) { ?>
                <!-- ログイン時のメニュー -->
                <div>
                    <ul>
                        <a href="postArticle.php">
                            <li>投稿</li>
                        </a>
                        <a href="favoriteArticle.php">
                            <li>お気に入り記事</li>
                        </a>
                        <a href="latestArticle.php">
                            <li>最新記事一覧</li>
                        </a>
                        <a href="search.php">
                            <li>詳細検索</li>
                        </a>
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>

                        <!-- アンケート -->
                        <?php if($ini["questionnaire"]) { ?>
                        
                        <a href="<?php echo $ini["questionnaire_url"] ?>" target="_blank">
                            <li>アンケート</li>
                        </a>

                        <?php } ?>
                    </ul>
                </div>
                <div>
                    <a href="logout.php">
                        ログアウト
                    </a>
                </div>

                <?php } else { ?>
                <div>
                    <ul>
                        <!-- 未ログイン時のメニュー -->
                        <a href="latestArticle.php">
                            <li>最新記事一覧</li>
                        </a>
                        <a href="search.php">
                            <li>詳細検索</li>
                        </a>
                        <a href="createAccount.php">
                            <li>新規登録</li>
                        </a>

                        <!-- アンケート -->
                        <?php if($ini["questionnaire"]) { ?>
                        
                        <a href="<?php echo $ini["questionnaire_url"] ?>" target="_blank">
                            <li>アンケート</li>
                        </a>

                        <?php } ?>
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

                    <!-- Google Map -->
                    <div id="map"></div>
                    <div id="search">
                        <input type="text" name="search" id="input-search" placeholder="タイトル検索">
                    </div>
                    <!-- 最新記事 -->
                    <div id="cotainer-latest-articles">
                        <h2>最 新 記 事</h2>

                        <div class="articles">
                            <?php if (count($lar) == 0) { ?>
                            <div class="article-none">
                                <p>最新記事がありません。</p>
                            </div>
                        </div>
                        <?php

                                } else {

                                    for ($i = 0; $i < (count($lar) > 3 ? 3 : count($lar)); $i++) {
                                        $src = readImageToBase64("./image/" . $lar[$i]["image"]);
                                        $imageWidth = getImageWidth("./image/" . $lar[$i]["image"]);
                                        $imageHeight = getImageHeight("./image/" . $lar[$i]["image"]);

                                        // workテーブルから作品名取得
                                        $sql = "SELECT title FROM work WHERE workID = " . $lar[$i]["workID"] . ";";
                                        $wr = $conn->query($sql)->fetch();

                                        ?>


                        <div class="article">
                            <div class="article-header">
                                <a href="view.php?v=<?php echo $lar[$i]["articleID"] ?>">
                                    <?php if ($src) { ?>

                                    <img src="<?php echo $src ?>" <?php

                                        if ($imageWidth > $imageHeight)
                                            echo "width=\"150\"";
                                        else
                                            echo "height=\"150\"";

                                        ?>>

                                    <?php } else { ?>

                                    <img src="<?php echo $noimage ?>" alt="no image" width="150">

                                    <?php } ?>
                                </a>
                            </div>
                            <div class="article-info">
                                <div>
                                    <div></div>
                                    <p><?php echo $lar[$i]["date"] ?></p>
                                </div>
                                <p class="name"><?php echo $lar[$i]["name"] ?></p>
                                <p class="title"><?php echo $wr["title"] ?></p>
                            </div>
                        </div>

                        <?php } ?>





                    </div>
                    <div class="more">
                        <a href="latestArticle.php">もっと見る</a>
                    </div>
                    <?php } ?>
                </div>

                <?php if ($login) { ?>

                <!-- お気に入り記事 -->
                <div id="cotainer-favorite-articles">
                    <h2>お 気 に 入 り 記 事</h2>

                    <div class="articles">
                        <?php if (count($air) == 0) { ?>
                        <div class="article-none">
                            <p>お気に入り記事がありません。</p>
                        </div>
                        <?php

                                        } else {

                                            for ($i = 0; $i < count($air); $i++) {
                                                $sql = "SELECT * FROM article WHERE articleID = " . $air[$i]["articleID"] . ";";
                                                $far = $conn->query($sql)->fetch();

                                                $src = readImageToBase64("./image/" . $far["image"]);
                                                $imageWidth = getImageWidth("./image/" . $far["image"]);
                                                $imageHeight = getImageHeight("./image/" . $far["image"]);

                                                // workテーブルから作品名取得
                                                $sql = "SELECT title FROM work WHERE workID = " . $far["workID"] . ";";
                                                $wr = $conn->query($sql)->fetch();
                                                ?>

                        <div class="article">
                            <div class="article-header">
                                <a href="view.php?v=<?php echo $far["articleID"] ?>">
                                    <?php if ($src) { ?>

                                    <img src="<?php echo $src ?>" <?php

                                                                                                        if ($imageWidth > $imageHeight)
                                                                                                            echo "width=\"150\"";
                                                                                                        else
                                                                                                            echo "height=\"150\"";

                                                                                                        ?>>

                                    <?php } else { ?>

                                    <img src="<?php echo $noimage ?>" alt="no image" width="150">

                                    <?php } ?>
                                </a>
                            </div>
                            <div class="article-info">
                                <div>
                                    <div> </div>
                                    <p><?php echo $lar[$i]["date"] ?></p>
                                </div>
                                <p class="name"><?php echo $far["name"] ?></p>
                                <p class="title"><?php echo $wr["title"] ?></p>
                            </div>
                        </div>

                        <?php } ?>


                    </div>
                    <div class="more">
                        <a href="favoriteArticle.php">もっと見る</a>
                    </div>


                    <?php } ?>
                </div>
                <?php } ?>
        </div>



        <div id="container-popular-titles">
            <h2>人 気 タ イ ト ル</h2>
            <div id="popular-title">
                <ol>
                    <?php

                            for ($i = 0; $i < count($par); $i++) {
                                $sql = "SELECT workID, title, titlePseudonym, type FROM work WHERE workID = " . $par[$i]["workID"] . ";";
                                $result = $conn->query($sql)->fetch();

                                ?>

                    <li>
                        <div><?php echo $i + 1 ?></div>
                        <a
                            href="article.php?wid=<?php echo $result["workID"] ?>"><ruby><?php echo $result["title"] . "<rt>" . $result["titlePseudonym"] . "</rt></ruby>"?></a>
                        <p><?php echo $typeStr[$result["type"]]?></p>
                    </li>

                    <?php } ?>
                </ol>
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

    <script src="js/map.js?202107212007"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>