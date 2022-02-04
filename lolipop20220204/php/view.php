<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>記事閲覧 - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">
    <style>
    #map {
        width: 480px;
        height: 320px;
    }

    #button-go,
    #button-favorite {
        background-color: #2c4558;
        color: #ffffff;

        border: solid 3px #2c4558;
        border-radius: 5px;
    }

    #button-go[data-push="true"],
    #button-favorite[data-push="true"] {
        background-color: #f75b5b;
        color: #2c4558;
        padding: 2px;
        border: solid 3px #2c4558;
        border-radius: 5px;
    }
    </style>

    <script src="https://maps.google.com/maps/api/js?key=AIzaSyD1IppMdLlsPjuGuUGZWQviMmc2brYPARo&language=ja"></script>
    <script>
    <?php if ($login) { ?>

    const uid = <?php echo $userID ?>;

    <?php } ?>

    const mapData = [

        {
            address: "<?php echo $result["sAddress1"] . $result["sAddress2"] . $result["sAddress3"] ?>",
            title: "<?php echo $result["name"] ?>",
            comment: "<?php echo str_replace(array("\r\n","\r", "\n"), "\\n", $result["details"]) ?>",
            url: "view.php?v=<?php echo $result["articleID"] ?>",
            zoom: 10
        }

    ];
    </script>
    <script src="js/include/util.js?202112141602"></script>
    <script src="js/view.js?202112141602"></script>
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
                    <div id="container-view">
                        <!-- 記事が見つからなかった場合 -->
                        <?php if ($nf) { ?>

                        <p>対象の記事は存在しない、もしくは削除された可能性があります。</p>

                        <?php } else { ?>

                        <div id="container-info">
                            <div>
                                <!-- Google Map -->
                                <div id="map"></div>
                            </div>
                            <div class="article">
                                <?php

                                    $src = readImageToBase64("./image/" . $result["image"]);

                                    if ($src) {

                                        ?>

                                <img id="main-img" src="<?php echo $src ?>">

                                <?php 
                            
                                } else { 
                                    $src = readImageToBase64("./image/noimage.png");
                                    
                                ?>

                                <img id="main-img" src="<?php echo $src ?>" alt="no image">

                                <?php } ?>
                                <div class="article-header">
                                    <p><?php echo $result["date"] ?></p>
                                </div>
                                <div id="user-info">
                                    <?php

                                    // アイコンが設定されていないならば初期アイコンを表示
                                    if ($ur["icon"] == null) {
                                        $filename = "default_icon.png";
                                    } else {
                                        $filename = $ur["icon"];
                                    }

                                    $iconSrc = readImageToBase64("./icon/" . $filename);

                                    ?>

                                    <div>
                                        <a href="mypage.php?uid=<?php echo $ur["userID"] ?>">
                                            <img src="<?php echo $iconSrc ?>" class="user-icon" alt="" width="100">
                                        </a>
                                    </div>
                                    <div>
                                        <a href="mypage.php?uid=<?php echo $ur["userID"] ?>">
                                            <h3 class="user-name"><?php echo $ur["username"] ?></h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="article-content">
                                    <p class="head-name">聖地名</p>
                                    <p class="article-content-name"><?php echo $result["name"] ?></p>
                                    <p class="head-details">聖地詳細</p>
                                    <p class="article-content-details"><?php

                                                    if ($result["details"] == null) {
                                                        echo "なし";
                                                    } else {
                                                        echo $result["details"];
                                                    }

                                                    ?></p>

                                    <p class="head-sAddress">住所</p>
                                    <p class="article-content-sAddress">
                                        <?php echo $result["sAddress1"] . $result["sAddress2"] . $result["sAddress3"] ?>
                                    </p>
                                    <p class="head-title">作品名</p>
                                    <p class="article-content-title"><span><?php echo $wr["title"] ?></span></p>
                                </div>
                                <div>
                                    <div id="button-container-top">
                                        <div>

                                            <button id="button-go" data-push="<?php

                                                                            if ($uaar) {
                                                                                echo "true";
                                                                            } else {
                                                                                echo "false";
                                                                            }

                                                                            ?>"
                                                data-aid="<?php echo $articleID ?>">行きたい<?php echo $result["go"] ?></button>
                                            <button id="button-route" class="disable" data-dest="">行き方</button>
                                            <button id="button-favorite" data-push="<?php

                                                                                if ($far) {
                                                                                    echo "true";
                                                                                } else {
                                                                                    echo "false";
                                                                                }

                                                                                ?>"
                                                data-aid="<?php echo $articleID ?>"><span></span></button>
                                        </div>
                                    </div>
                                    <div id="button-container-buttom">
                                        <?php if($hostFlag && $mode == "host") { ?>

                                        <button id="button-remove-article"
                                            data-aid="<?php echo $articleID ?>">削除</button>

                                        <?php } else { ?>

                                        <label class="button-show-report open" for="pop-up1"
                                            data-aid="<?php echo $articleID ?>">通報</label>

                                        <?php } ?>
                                        <input type="checkbox" id="pop-up1">
                                        <div class="overlay">
                                            <div class="window">
                                                <div class="window-top">
                                                    <h2>通報フォーム</h2>
                                                    <label class="close" for="pop-up1">×</label>
                                                </div>
                                                <div id="report-container">
                                                    <div class="report-container-main">
                                                        <div>
                                                            <p>報告内容</p>

                                                            <input type="radio" name="inputReportType"
                                                                id="input-report-type1" value="1">
                                                            <label for="input-report-type1">内容が虚偽である</label><br>

                                                            <input type="radio" name="inputReportType"
                                                                id="input-report-type2" value="2">
                                                            <label for="input-report-type2">不適切な内容が含まれている</label><br>

                                                            <input type="radio" name="inputReportType"
                                                                id="input-report-type3" value="3">
                                                            <label for="input-report-type3">その他</label><br>
                                                        </div>
                                                        <div>
                                                            <p>詳細</p>
                                                            <textarea name="inputReportDetails"
                                                                id="input-report-details" cols="30" rows="10"
                                                                placeholder=""></textarea><br>

                                                            <input type="hidden" name="inputReportAid"
                                                                id="input-report-aid" value="<?php echo $articleID ?>">
                                                        </div>
                                                    </div>
                                                    <button id="button-report" type="button">通報</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="comment-button">
                            <label id="button-post-comment" class="open" for="pop-up">コメントする</label>
                            <input type="checkbox" id="pop-up">
                            <div class="overlay">
                                <div class="window">
                                    <div class="comment-top">
                                        <h2>コメント</h2>
                                        <label class="close" for="pop-up">×</label>
                                    </div>
                                    <form action="postComment.php?aid=<?php echo $result["articleID"] ?>" method="POST"
                                        name="formComment" enctype="multipart/form-data">
                                        <div class="form-top">
                                            <!-- <label for="textarea-form-comment">コメント</label><br> -->
                                            <textarea name="formCommentComment" id="textarea-form-comment" cols="24"
                                                rows="10"></textarea>
                                        </div>
                                        <div class="form-center">
                                            <label for="input-image">画像を選択</label>
                                            <input type="file" accept="image/png, image/jpeg" name="formCommentImage"
                                                id="input-image">
                                        </div>
                                        <div class="form-buttom">
                                            <span id="button-form-comment-cancel">キャンセル</span>
                                            <span id="button-form-comment-submit">送信</span>
                                            <span></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="comment-container">

                            <div id="container-comments">
                                <div class="comment-header">
                                    <p>コメント</p>
                                    <p><?php echo count($cr) ?>件</p>
                                </div>


                                <?php

                                    for ($i = 0; $i < count($cr); $i++) {
                                        // ユーザー情報
                                        // ur: User Result
                                        $sql = "
                                            SELECT userID, username, icon 
                                            FROM user 
                                            WHERE 
                                                userID = ?;
                                        ";
                                        $ucr = execsql($conn, $sql, array($cr[$i]["userID"]))->fetch();

                                        // アイコンが設定されていないならば初期アイコンを表示
                                        if ($ucr["icon"] == null) {
                                            $filename = "default_icon.png";
                                        } else {
                                            $filename = $ucr["icon"];
                                        }

                                        if ($iconSrc = readImageToBase64("./icon/" . $filename));

                                        ?>

                                <div class="comment">
                                    <div class="comment-icon">
                                        <a href="mypage.php?uid=<?php echo $ucr["userID"] ?>">
                                            <img class="user-icon" src="<?php echo $iconSrc ?>">
                                        </a>
                                    </div>
                                    <div class="comment-info">
                                        <div class="username">
                                            <a href="mypage.php?uid=<?php echo $ucr["userID"] ?>">
                                                <h3><?php echo $ucr["username"] ?></h3>
                                            </a>
                                            <?php if(($hostFlag && $mode == "host") || ($login && $ucr["userID"] == $userID)) { ?>
                                            <div>
                                                <button class="button-remove-comment"
                                                    data-cid="<?php echo $cr[$i]["commentID"] ?>">削除</button>
                                            </div>

                                            <?php } ?>
                                        </div>
                                        <div class="comment-body">
                                            <?php echo htmlspecialchars($cr[$i]["comment"]) ?>
                                        </div>

                                        <?php if ($cr[$i]["image"] == null) { ?>



                                        <?php

                                                } else {
                                                    if ($imageSrc = readImageToBase64("./image/" . $cr[$i]["image"]));

                                                    ?>

                                        <img class="comment-image" src="<?php echo $imageSrc ?>">

                                        <?php } ?>


                                    </div>
                                </div>

                                <?php } ?>
                                <?php } ?>
                            </div>
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


    <script src="js/map.js?202112131239"></script>

</body>

</html>