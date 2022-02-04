<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $result["username"] ?>さんのマイページ - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">

    <script src="js/include/util.js?202112141602"></script>
    <script src="js/mypage.js?202112141602"></script>
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <img src="wp_contents/image/logo.png" alt="">
                </a>
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

                        <!-- 自分のマイページの場合 -->
                        <?php if($page == "me") { ?>

                        <a href="changeProfile.php">
                            <li>プロフィール変更</li>
                        </a>
                        <a href="changePassword.php">
                            <li>パスワード変更</li>
                        </a>
                        <a href="changeEmailAddress.php">
                            <li>メールアドレス変更</li>
                        </a>
                        <?php } else {?>
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>
                        <?php } ?>
                    </ul>
                </div>
                <div>
                    <a href="logout.php">
                        ログアウト
                    </a>
                </div>
            </header>
        </div>
        <div id="container">
            <main>

                <div id="main-container">

                    <div id="container-mypage">
                        <div id="user-info">
                            <?php

                            // アイコンが設定されていないならば初期アイコンを表示
                            if ($result["icon"] == null) {
                                $filename = "default_icon.png";
                            } else {
                                $filename = $result["icon"];
                            }

                            $iconSrc = readImageToBase64("./icon/" . $filename);

                            ?>
                            <div class="m-icon">
                                <img src="<?php echo $iconSrc ?>" alt="">
                            </div>
                            <div class="m-content">
                                <div class="m-name">
                                    <div>
                                        <p id="username-body"><?php echo $result["username"] ?></p>
                                    </div>
                                </div>
                                <div class="m-comment">
                                    <p id="comment-body"><?php echo $result["uComment"] ?></p>
                                </div>
                            </div>
                        </div>



                        <div id="article-container">
                            <div class="article-container-header">
                                <h2>投稿一覧</h2>
                                <p><?php echo count($ar) ?>件</p>
                            </div>
                            <?php if (count($ar) == 0) { ?>

                            <p>投稿がありません</p>

                            <?php

                                } else {
                                    for ($i = 0; $i < count($ar); $i++) {
                                        // 作品名を取得
                                        // wr: Work Result
                                        $sql = "SELECT title FROM work WHERE workID = " . $ar[$i]["workID"] . ";";
                                        $wr = $conn->query($sql)->fetch();

                                        $src = readImageToBase64("./image/" . $ar[$i]["image"]);

                                        ?>

                            <div class="article">
                                <a href="view.php?v=<?php echo $ar[$i]["articleID"] ?>">
                                    <?php if ($src) { ?>

                                    <img src="<?php echo $src ?>" alt="" height="200">

                                    <?php 
                                
                                    } else { 
                                        $src = readImageToBase64("./image/noimage.png");    
                                        
                                    ?>

                                    <img src="<?php echo $src ?>" alt="no image" width="250">

                                    <?php } ?>
                                </a>
                                <div class="m-content">
                                    <div class="article-top">
                                        <span class="article-info go">行きたい <?php echo $ar[$i]["go"] ?></span>
                                        <?php if($page == "me") { ?>

                                        <div class="artice-button">
                                            <button class="button-edit"
                                                data-aid="<?php echo $ar[$i]["articleID"] ?>">編集</button>
                                            <button class="button-remove"
                                                data-aid="<?php echo $ar[$i]["articleID"] ?>">削除</button>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="article-info">
                                        <p class="head-name">聖地名</p>
                                        <p class="name"><label><?php echo $ar[$i]["name"] ?></label></p>
                                        <p class="head-details">聖地詳細</p>
                                        <p><label><?php 
                                        if ($ar[$i]["details"] == null) {
                                                                echo "なし";
                                                            } else {
                                                                echo $ar[$i]["details"];
                                                            }
                                        ?></label></p>
                                        <p class="head-sAddress">住所</p>
                                        <p><label><?php echo $ar[$i]["sAddress1"] . $ar[$i]["sAddress2"] . $ar[$i]["sAddress3"] ?></label>
                                        </p>
                                        <p class="head-title">作品名</p>
                                        <p class="title"><span><?php echo $wr["title"] ?></span></p>
                                    </div>
                                </div>
                            </div>

                            <?php

                                }
                            }

                            ?>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>