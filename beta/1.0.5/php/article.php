<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $wr["title"] . "（" . $wr["titlePseudonym"] . "）" ?>の記事一覧 - SEITI</title>

    <link rel="stylesheet" href="css/article.css?202110212021">
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="top.php">
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

                <h2><?php echo $wr["title"] . "（" . $wr["titlePseudonym"] . "）" ?></h2>

                <div id="articles-container">
                    <?php

                    if (count($result) > 0) {
                        for ($i = 0; $i < count($result); $i++) {
                            $src = readImageToBase64("./image/" . $result[$i]["image"]);

                            ?>

                    <div class="article-container">
                        <a href="view.php?v=<?php echo $result[$i]["articleID"] ?>">

                            <?php if ($src) { ?>

                            <img src="<?php echo $src ?>" alt="">

                            <?php } else { ?>

                            <div class="no-image">No image</div>

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

                        <span id="go">行きたい<?php echo $result[$i]["go"] ?></span>
                    </div>

                    <?php

                            }
                        } else {

                            ?>

                    <p>該当作品の記事が見つかりませんでした。</p>

                    <?php } ?>
                </div>

            </main>
        </div>

        <footer></footer>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>