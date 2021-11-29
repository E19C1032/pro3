<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>トップ - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">

    <style>
    #map {
        margin-top: 2vh;
        width: 100%;
        height: 320px;
    }
    </style>

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
    <script src="js/top.js?202111221630"></script>
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <h1>SEITI</h1>
                </a>


                <div>
                    <ul>
                        <?php if ($login) { ?>

                        <!-- ログイン時のメニュー -->
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
                        <a href="logout.php">
                            <li>ログアウト</li>
                        </a>

                        <?php if($ini["questionnaire"]) { ?>
                        
                        <a href="<?php echo $ini["questionnaire_url"] ?>" target="_blank">
                            <li>アンケート</li>
                        </a>

                        <?php } ?>

                        <?php } else { ?>

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
                        <a href="login.php">
                            <li>ログイン</li>
                        </a>

                        <?php if($ini["questionnaire"]) { ?>
                        
                        <a href="<?php echo $ini["questionnaire_url"] ?>" target="_blank">
                            <li>アンケート</li>
                        </a>

                        <?php } ?>

                        <?php } ?>
                    </ul>
                </div>

            </header>
        </div>

        <div id="container">
            <main>

                <div id="main-container">
                    <input type="text" name="search" id="input-search" placeholder="検索">

                    <!-- Google Map -->
                    <div id="map" width="480" height="320"></div>

                    <!-- 最新記事 -->
                    <div id="cotainer-latest-articles">
                        <h2>最新記事</h2>

                        <div class="articles">
                            <?php if (count($lar) == 0) { ?>

                            <p>最新記事がありません。</p>

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
                                    <p>聖地名：<?php echo $lar[$i]["name"] ?></p>
                                    <p>作品名：<?php echo $wr["title"] ?></p>
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
                        <h2>お気に入り記事</h2>

                        <div class="articles">
                            <?php if (count($air) == 0) { ?>
                            <div>
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
                                    <p>聖地名：<?php echo $far["name"] ?></p>
                                    <p>作品名：<?php echo $wr["title"] ?></p>
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
                    <h2>人気タイトル</h2>
                    <div id="popular-title">
                        <ol>
                            <?php

                            for ($i = 0; $i < count($par); $i++) {
                                $sql = "SELECT workID, title, titlePseudonym, type FROM work WHERE workID = " . $par[$i]["workID"] . ";";
                                $result = $conn->query($sql)->fetch();

                                ?>

                            <li><a
                                    href="article.php?wid=<?php echo $result["workID"] ?>"><?php echo $result["title"] . "（" . $result["titlePseudonym"] . "）（" . $typeStr[$result["type"]] . "）" ?></a>
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