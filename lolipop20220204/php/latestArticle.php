<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>最新記事一覧 - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">

    <script>
    <?php if ($login) { ?>

    const uid = <?php echo $userID ?>;

    <?php } ?>
    </script>
    <script src="js/latestArticle.js?202112141602"></script>
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <img src="wp_contents/image/logo.png" alt="">
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
                    <div id="container-latestArticle">
                        <div class="container-header">
                            <p>最新記事一覧
                            </p>
                        </div>
                        <p class="latest-article-count"><?php echo count($result) ?>件</p>
                        <div id="articles-container">
                            <?php

                            for ($i = 0; $i < count($result); $i++) {
                                // 作品タイトル
                                // wr: Work Result
                                $sql = "SELECT title FROM work WHERE workID = " . $result[$i]["workID"] . ";";
                                $wr = $conn->query($sql)->fetch();

                                // ユーザー情報
                                // ur: User Result
                                $sql = "SELECT username, icon FROM user WHERE userID = " . $result[$i]["userID"] . ";";
                                $ur = $conn->query($sql)->fetch();

                                if ($ur["icon"] == null) {
                                    $filename = "default_icon.png";
                                } else {
                                    $filename = $ur["icon"];
                                }

                                $iconSrc = readImageToBase64("./icon/" . $filename);
                                $imageSrc = readImageToBase64("./image/" . $result[$i]["image"]);
                                $imageWidth = getImageWidth("./image/" . $result[$i]["image"]);
                                $imageHeight = getImageHeight("./image/" . $result[$i]["image"]);

                                $far = false;
                                if($login) {
                                    $sql = "
                                        SELECT * 
                                        FROM favoritearticle 
                                        WHERE 
                                            userID = ? AND 
                                            articleID = ?;
                                    ";
                                    $far = execsql($conn, $sql, array($userID, $result[$i]["articleID"]));
                                    if(empty($far)) {
                                        $far = false;
                                    } else {
                                        $far = $far->fetch();
                                    }
                                }

                                ?>

                            <div class="article">
                                <div class="article-header">
                                    <a href="view.php?v=<?php echo $result[$i]["articleID"] ?>">
                                        <div class="image-container">
                                            <?php if ($imageSrc) { ?>

                                            <img src="<?php echo $imageSrc ?>" alt="" <?php

                                                                                                        if ($imageWidth > $imageHeight) {
                                                                                                            echo "width=\"150\"";
                                                                                                        } else {
                                                                                                            echo "height=\"150\"";
                                                                                                        }

                                                                                                        ?>>

                                            <?php } else { ?>

                                            <img src="<?php echo $noimage ?>" alt="no image" width="150">

                                            <?php } ?>
                                        </div>
                                    </a>
                                </div>
                                <div class="article-info">
                                    <div class="article-date">
                                        <?php echo $result[$i]["date"] ?>
                                    </div>
                                    <div class="article-user">
                                        <img src="<?php echo $iconSrc ?>" width="50">
                                        <span class="username"><?php echo $ur["username"] ?></span>
                                    </div>
                                    <p class="head-name">聖地名</p>
                                    <p class="name"><?php echo $result[$i]["name"] ?></p>
                                    <p class="head-details">聖地詳細</p>
                                    <p class="details"><?php

                                                            if ($result[$i]["details"] == null) {
                                                                echo "なし";
                                                            } else {
                                                                echo $result[$i]["details"];
                                                            }

                                                            ?></p>
                                    <p class="head-title">作品名</p>
                                    <p class="title"><span><?php echo $wr["title"] ?></span></p>
                                    <div class="button-favorite-container">
                                        <button class="button-favorite" data-push="<?php

                                                                                        if ($far) {
                                                                                            echo "true";
                                                                                        } else {
                                                                                            echo "false";
                                                                                        }

                                                                                        ?>"
                                            data-aid="<?php echo $result[$i]["articleID"] ?>"><span></span></button>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </main>
            <footer>
                <div id="footer-top">
                    <div>
                        <img src="wp_contents/image/logo_footer.png" alt="">
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

</body>

</html>