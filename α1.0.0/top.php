<?php

require "include/readIni.php";
require "include/pdoConnect.php";
require "include/util.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// ログインしているならばDBからユーザー情報を確保
if($login) {
    $sql = "SELECT * FROM user WHERE userID = ".$userID.";";
    $result = $conn->query($sql)->fetch();
}

// 最新記事
// lar: Latest Article Result
$sql = "SELECT * FROM article ORDER BY date DESC LIMIT 3;";
$lar = $conn->query($sql)->fetchAll();

// お気に入り記事のID
// air: Article ID Result
if($login) {
    $sql = "SELECT articleID FROM favoriteArticle WHERE userID = ".$userID.";";
    $air = $conn->query($sql)->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>トップページ - SEITI</title>

        <link rel="stylesheet" href="css/common.css?202107212014">

        <style>

        #map {
            width: 480px;
            height: 320px;
        }

        </style>

        <script src="http://maps.google.com/maps/api/js?key=AIzaSyD1IppMdLlsPjuGuUGZWQviMmc2brYPARo&language=ja"></script>
        <script src="js/map.js?202107212007"></script>
        <script src="js/top.js"></script>
    </head>
    <body>

        <div id="container">

            <header>

                <a href="top.php"><h1>SEITI</h1></a>
                <input type="text" name="search" class="unimp" id="input-search" placeholder="検索">
                <?php if($login) { ?><h2>ユーザー名：<?php echo($result["username"]) ?></h2><?php } ?>

                <div>
                    <ul>
                        <?php if($login) { ?>

                        <!-- ログイン時のメニュー -->
                        <a href="postArticle.php"><li>投稿</li></a>
                        <a><li class="unimp">お気に入り記事</li></a>
                        <a href="latestArticle.php"><li>最新記事一覧</li></a>
                        <a><li class="unimp">詳細検索</li></a>
                        <a href="mypage.php"><li>マイページ</li></a>
                        <a href="logout.php"><li>ログアウト</li></a>

                        <?php } else { ?>

                        <!-- 未ログイン時のメニュー -->
                        <a href="latestArticle.php"><li>最新記事一覧</li></a>
                        <a><li class="unimp">詳細検索</li></a>
                        <a href="createAccount.php"><li>新規登録</li></a>
                        <a href="login.php"><li>ログイン</li></a>

                        <?php } ?>
                    </ul>
                </div>

                <hr>

            </header>

            <main>

                <div id="main-container">

                    <!-- Google Map -->
                    <div id="map" width="480" height="320"></div>

                    <!-- 最新記事 -->
                    <div id="cotainer-latest-articles">
                        <h2>最新記事</h2>

                        <div class="articles">
                            <?php if(count($lar) == 0) { ?>

                            <p>お気に入り記事がありません。</p>

                            <?php
                            
                            } else {
                                
                                for($i = 0; $i < count($lar); $i++) {
                                    $src = readImageToBase64("./image/".$lar[$i]["image"]);
                                    $imageWidth = getImageWidth("./image/".$lar[$i]["image"]);
                                    $imageHeight = getImageHeight("./image/".$lar[$i]["image"]);

                                    // workテーブルから作品名取得
                                    $sql = "SELECT title FROM work WHERE workID = ".$lar[$i]["workID"].";";
                                    $wr = $conn->query($sql)->fetch();
                                
                            ?>

                
                            <div class="article">
                                <div class="article-header">
                                    <a href="view.php?v=<?php echo($lar[$i]["articleID"]) ?>">
                                        <?php if($src) { ?>

                                        <img src="<?php echo($src) ?>"
                                        
                                        <?php
                                        
                                        if($imageWidth > $imageHeight)
                                            echo("width=\"300\"");
                                        else
                                            echo("height=\"300\"");
                                        
                                        ?>

                                        >

                                        <?php } else { ?>

                                        <div class="no-image">No image</div>

                                        <?php } ?>
                                    </a>
                                </div>
                                <div class="article-info">
                                    <p>聖地名：<?php echo($lar[$i]["name"]) ?></p>
                                    <p>作品名：<?php echo($wr["title"]) ?></p>
                                </div>
                            </div>

                            <?php } ?>

                            <div class="more">
                                <a href="latestArticle.php">もっと見る</a>
                            </div>

                            <?php } ?>    

                        </div>

                    </div>

                    <?php if($login) { ?>

                    <!-- お気に入り記事 -->
                    <div id="cotainer-favorite-articles">
                        <h2>お気に入り記事</h2>

                        <div class="articles">
                            <?php if(count($air) == 0) { ?>

                            <p>お気に入り記事がありません。</p>

                            <?php
                            
                            } else {

                            for($i = 0; $i < count($air); $i++) {
                                $sql = "SELECT * FROM article WHERE articleID = ".$air[$i]["articleID"].";";
                                $far = $conn->query($sql)->fetch();

                                $src = readImageToBase64("./image/".$far["image"]);
                                $imageWidth = getImageWidth("./image/".$far["image"]);
                                $imageHeight = getImageHeight("./image/".$far["image"]);

                                // workテーブルから作品名取得
                                $sql = "SELECT title FROM work WHERE workID = ".$far["workID"].";";
                                $wr = $conn->query($sql)->fetch();
                            ?>

                            <div class="article">
                                <div class="article-header">
                                    <a href="view.php?v=<?php echo($far["articleID"]) ?>">
                                        <?php if($src) { ?>

                                        <img src="<?php echo($src) ?>"
                                        
                                        <?php
                                        
                                        if($imageWidth > $imageHeight)
                                            echo("width=\"300\"");
                                        else
                                            echo("height=\"300\"");
                                        
                                        ?>

                                        >

                                        <?php } else { ?>

                                        <div class="no-image">No image</div>

                                        <?php } ?>
                                    </a>
                                </div>
                                <div class="article-info">
                                    <p>聖地名：<?php echo($far["name"]) ?></p>
                                    <p>作品名：<?php echo($wr["title"]) ?></p>
                                </div>
                            </div>

                            <?php } ?>

                            <div class="more">
                                <a href="favoriteArticle.php">もっと見る</a>
                            </div>
                            
                            <?php } ?>

                        </div>
                    </div>

                    <?php } ?> 

                </div>

            </main>

            <footer>

                <div id="version"><?php echo($ini["version"]) ?></div>

            </footer>

        </div>
            
    </body>
</html>