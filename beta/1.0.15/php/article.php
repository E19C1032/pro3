<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $wr["title"] . "（" . $wr["titlePseudonym"] . "）" ?>の記事一覧 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">
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
    <script src="js/article.js?202111221630"></script>
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
                    <div id="container-article">
                        <h2><?php echo $wr["title"] . "（" . $wr["titlePseudonym"] . "）" ?></h2>

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

                            <div class="article-container" data-go="<?php echo $result[$i]["go"] ?>" data-date="<?php echo $result[$i]["date"] ?>">
                                <a href="view.php?v=<?php echo $result[$i]["articleID"] ?>">

                                    <?php if ($src) { ?>

                                    <img src="<?php echo $src ?>" alt="">

                                    <?php 
                                
                                    } else { 
                                        $src = readImageToBase64("./image/noimage.png");
                                        
                                    ?>

                                    <img src="<?php echo $src ?>" alt="no image" width="150">

                                    <?php } ?>

                                </a>

                                <table>
                                    <tbody>
                                        <tr>
                                            <th>聖地名</th>
                                            <td><?php echo $result[$i]["name"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>作品名</th>
                                            <td><?php echo $wr["title"] . "（" . $wr["titlePseudonym"] . "）" ?></td>
                                        </tr>
                                        <tr>
                                            <th>住所</th>
                                            <td><?php echo $result[$i]["sAddress1"] . $result[$i]["sAddress2"] . $result[$i]["sAddress3"] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>聖地詳細</th>
                                            <td><?php echo $result[$i]["details"] ?></td>
                                        </tr>
                                    </tbody>
                                </table>

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
                                        <label class="close" for="pop-up2">×</label>
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

                                            <input type="hidden" name="inputReportAid" id="input-report-aid" value="">

                                            <button id="button-report" type="button">通報</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>