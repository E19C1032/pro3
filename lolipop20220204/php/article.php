<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $wr["title"] . "（" . $wr["titlePseudonym"] . "）" ?>の記事一覧 - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">
    <style>
    button[data-push="false"] {
        background-color: #2c4558;
        color: white;
        padding: 2px;
        border: solid 3px #2c4558;
        border-radius: 5px;
    }

    button[data-push="true"] {
        background-color: #f75b5b;
        color: #2c4558;
        padding: 2px;
        border: solid 3px #2c4558;
        border-radius: 5px;
    }
    </style>

    <script>
    <?php if ($login) { ?>

    const uid = <?php echo $userID ?>;

    <?php } ?>

    const wid = <?php echo $workID ?>;
    </script>
    <script src="js/article.js?202112141602"></script>
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
                    <div id="container-article">
                        <div class="container-header">
                            <p><?php echo $wr["title"] . "（" . $wr["titlePseudonym"] . "）" ?></p>
                        </div>
                        <select name="selectSort" id="select-sort">
                            <option value="date">新着順</option>
                            <option value="go">人気順</option>
                        </select>

                        <div id="articles-container">
                            <?php

                            if (count($result) > 0) {
                                for ($i = 0; $i < count($result); $i++) {
                                    $gr = false;
                                    if($login) {
                                        $sql = "SELECT * FROM go WHERE userID = " . $userID . " AND articleID = " . $result[$i]["articleID"] . ";";
                                        $gr = $conn->query($sql)->fetch();
                                    }

                                    $src = readImageToBase64("./image/" . $result[$i]["image"]);

                                    ?>

                            <div class="article" data-go="<?php echo $result[$i]["go"] ?>"
                                data-date="<?php echo $result[$i]["date"] ?>">
                                <div class="article-header">
                                    <a href="view.php?v=<?php echo $result[$i]["articleID"] ?>">

                                        <?php if ($src) { ?>

                                        <img src="<?php echo $src ?>" style="height: 200px; display: block;
                                                                            border-radius: 10px 10px 0 0;
                                                                            height: 200px;
                                                                            width: 100%;
                                                                            
                                                                            object-fit: cover;">

                                        <?php 
                                
                                    } else { 
                                        $src = readImageToBase64("./image/noimage.png");
                                        
                                    ?>

                                        <img src="<?php echo $src ?>" alt="no image" style="height: 200px; display: block;
                                                                                            border-radius: 10px 10px 0 0;
                                                                                            height: 200px;
                                                                                            width: 100%;
                                                                                            
                                                                                            object-fit: cover;">

                                        <?php } ?>

                                    </a>
                                </div>
                                <div class="article-info">
                                    <div class="article-date">
                                        <?php echo $result[$i]["date"] ?>
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
                                        <button class="button-go" data-push="<?php

                                                                                        if ($gr) {
                                                                                            echo "true";
                                                                                        } else {
                                                                                            echo "false";
                                                                                        }

                                                                                        ?>"
                                            data-aid="<?php echo $result[$i]["articleID"] ?>">行きたい<?php echo $result[$i]["go"] ?></button>
                                        <label class="button-show-report open" for="pop-up2"
                                            data-aid="<?php echo $result[$i]["articleID"] ?>">通報</label>
                                        <input type="checkbox" id="pop-up2">
                                        <div class="overlay">
                                            <div class="window">
                                                <div class="window-top">
                                                    <h2>通報フォーム</h2>
                                                    <label class="close" for="pop-up2">×</label>
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

                            <?php

                                    }
                                } else {

                                    ?>

                            <p>該当作品の記事が見つかりませんでした。</p>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>