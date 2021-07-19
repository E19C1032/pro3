<?php

require "pdo_connect.php";
require "util.php";

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

        <link rel="stylesheet" href="css/common.css?2021071600010">
        <link rel="stylesheet" href="css/top.css?202107162320">
        <link rel="stylesheet" href="css/hamburgerMenu.css?202107141858">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="js/hamburgerMenu.js"></script>
        <script src="js/top.js"></script>
    </head>
    <body>

        <header>

            <a href="top.php"><h1>SEITI</h1></a>
            <input type="text" name="search" id="input-search" placeholder="検索">
            <?php if($login) { ?><h2>ユーザー名：<?php echo($result["username"]) ?></h2><?php } ?>

            <!-- ハンバーガーメニュー -->
            <div>
                <div class="hamburgerMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <ul class="openMenu">
                <?php if($login) { ?>

                <!-- ログイン時のメニュー -->
                <a href="post_article.php"><li>投稿</li></a>
                <a><li>お気に入り記事</li></a>
                <a href="latest_article.php"><li>最新記事一覧</li></a>
                <a><li>詳細検索</li></a>
                <a href="mypage.php"><li>マイページ</li></a>
                <a href="logout.php"><li>ログアウト</li></a>

                <?php } else { ?>

                <!-- 未ログイン時のメニュー -->
                <a href="latest_article.php"><li>最新記事一覧</li></a>
                <a><li>詳細検索</li></a>
                <a href="create_account.php"><li>新規登録</li></a>
                <a href="login.php"><li>ログイン</li></a>

                <?php } ?>
            </ul>

            <hr>

        </header>

        <main>

            <div id="main-container">

                <!-- Google Map -->
                <iframe src="https://www.google.com/maps/d/embed?mid=1fA30sCuMzD1jfc4yo9ObOS7yo54WNCV9" width="640" height="480"></iframe>

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
                            <a href="latest_article.php">もっと見る</a>
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
                            <a href="favorite_article.php">もっと見る</a>
                        </div>
                        
                        <?php } ?>

                    </div>
                </div>

                <?php } ?> 

            </div>

        </main>

        <footer>



        </footer>
            
    </body>
</html>