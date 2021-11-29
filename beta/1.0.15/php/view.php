<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>記事閲覧 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">
    <style>
    #map {
        width: 480px;
        height: 320px;
    }

    #button-go, #button-favorite {
        background-color: #2c4558;
        color: #ffffff;
        padding: 2px;
        border: solid 3px #2c4558;
        border-radius: 5px;
    }
    #button-go[data-push="true"], #button-favorite[data-push="true"] {
        background-color: #f75b5b;
        color: #2c4558;
        padding: 2px;
        border: solid 3px #2c4558;
        border-radius: 5px;
    }

    #container-info > div {
        margin-top: 20px; 
    }

    #main-img {
        width: 50%;
    }

    #user-info {
        display: flex;
    }

    #user-info > div {
        width: 120px;
        height: 120px;
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
    <script src="js/include/util.js?202111221630"></script>
    <script src="js/view.js?202111221630"></script>
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

                        <?php } ?>
                    </ul>
                </div>

            </header>
        </div>
        <div id="container">

            <main>

                <div id="main-container">
                    <div id="container-view">
                        <h2>記事情報</h2>
                        <!-- 記事が見つからなかった場合 -->
                        <?php if ($nf) { ?>

                        <p>対象の記事は存在しない、もしくは削除された可能性があります。</p>

                        <?php } else { ?>

                        <div id="container-info">
                            <div>
                                <!-- Google Map -->
                                <div id="map" width="480" height="320"></div>
                            </div>
                            <div>
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
                                <table id="article-info">
                                    <tbody>
                                        <tr>
                                            <th>聖地名</th>
                                            <td><?php echo $result["name"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>作品名</th>
                                            <td><?php echo $wr["title"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>住　所</th>
                                            <td><?php echo $result["sAddress1"] . $result["sAddress2"] . $result["sAddress3"] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>詳　細</th>
                                            <td>
                                                <?php

                                                    if ($result["details"] == null) {
                                                        echo "なし";
                                                    } else {
                                                        echo $result["details"];
                                                    }

                                                    ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div id="button-container">
                                    <button id="button-go" data-push="<?php

                                                                            if ($uaar) {
                                                                                echo "true";
                                                                            } else {
                                                                                echo "false";
                                                                            }

                                                                            ?>"
                                        data-aid="<?php echo $articleID ?>">行きたい<?php echo $result["go"] ?></button>
                                    <button id="button-favorite" data-push="<?php

                                                                                if ($far) {
                                                                                    echo "true";
                                                                                } else {
                                                                                    echo "false";
                                                                                }

                                                                                ?>"
                                        data-aid="<?php echo $articleID ?>">お気に入り</button>
                                    <?php if($hostFlag && $mode == "host") { ?>

                                    <button id="button-remove-article" data-aid="<?php echo $articleID ?>">削除</button>

                                    <?php } else { ?>

                                    <label class="button-show-report open" for="pop-up1"
                                        data-aid="<?php echo $articleID ?>">通報</label>

                                    <?php } ?>
                                    <input type="checkbox" id="pop-up1">
                                    <div class="overlay">
                                        <div class="window">
                                            <label class="close" for="pop-up1">×</label>

                                            <div id="report-container">
                                                <label for="">報告内容</label><br>

                                                <input type="radio" name="inputReportType" id="input-report-type1"
                                                    value="1">
                                                <label for="input-report-type1">内容が虚偽である</label><br>

                                                <input type="radio" name="inputReportType" id="input-report-type2"
                                                    value="2">
                                                <label for="input-report-type2">不適切な内容が含まれている</label><br>

                                                <input type="radio" name="inputReportType" id="input-report-type3"
                                                    value="3">
                                                <label for="input-report-type3">その他</label><br>

                                                <label for="input-report-details">詳細</label><br>
                                                <textarea name="inputReportDetails" id="input-report-details" cols="30"
                                                    rows="10" placeholder=""></textarea><br>

                                                <input type="hidden" name="inputReportAid" id="input-report-aid"
                                                    value="<?php echo $articleID ?>">

                                                <button id="button-report" type="button">通報</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label id="button-post-comment" class="open" for="pop-up">コメントする</label>
                        <input type="checkbox" id="pop-up">
                        <div class="overlay">
                            <div class="window">
                                <label class="close" for="pop-up">×</label>
                                <form action="postComment.php?aid=<?php echo $result["articleID"] ?>" method="POST"
                                    name="formComment" enctype="multipart/form-data">

                                    <label for="textarea-form-comment">コメント</label><br>
                                    <textarea name="formCommentComment" id="textarea-form-comment" cols="24"
                                        rows="10"></textarea><br>
                                    <label for="input-image">画像を選択</label><br>
                                    <input type="file" accept="image/png, image/jpeg" name="formCommentImage"
                                        id="input-image"><br><br>
                                    <span id="button-form-comment-cancel">キャンセル</span>
                                    <span id="button-form-comment-submit">送信</span><br>
                                </form>
                            </div>
                        </div>
                        <div id="container-comments">
                            <h2>コメント（<?php echo count($cr) ?>）</h2>

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
                                <div>
                                    <a href="mypage.php?uid=<?php echo $ucr["userID"] ?>">
                                        <img class="user-icon" src="<?php echo $iconSrc ?>" width="100" height="100">
                                    </a>
                                </div>
                                <div>
                                    <div class="username">
                                        <a href="mypage.php?uid=<?php echo $ucr["userID"] ?>">
                                            <h3><?php echo $ucr["username"] ?></h3>
                                        </a>
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

                                    <?php if(($hostFlag && $mode == "host") || ($login && $ucr["userID"] == $userID)) { ?>

                                    <button class="button-remove-comment"
                                        data-cid="<?php echo $cr[$i]["commentID"] ?>">削除</button>

                                    <?php } ?>
                                </div>
                            </div>

                            <?php } ?>
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


    <script src="js/map.js?202110260007"></script>

</body>

</html>