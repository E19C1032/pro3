<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo ($result["username"]) ?>さんのマイページ - SEITI</title>

    <link rel="stylesheet" href="css/common.css">

    <script src="js/mypage.js"></script>
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>

                <a href="top.php">
                    <h1>SEITI</h1>
                </a>

                <hr>

                <div id="menu-container">

                    <ul>
                        <li><a href="postArticle.php">投稿</a></li>
                        <li><a href="favoriteArticle.php">お気に入り記事一覧</a></li>
                        <li><a href="latestArticle.php">最新記事一覧</a></li>
                        <li><a href="search.php">詳細検索</a></li>
                        <li><a href="changeProfile.php">プロフィール変更</a></li>
                        <li><a href="changePassword.php">パスワード変更</a></li>
                        <li><a href="changeEmailAddress.php">メールアドレス変更</a></li>
                        <li><a href="logout.php">ログアウト</a></li>
                    </ul>

                </div>

            </header>
        </div>
        <div id="container">
            <main>

                <div id="main-container">

                    <div id="main-contents-container">

                        <h2>マイページ</h2>

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

                            <img src="<?php echo ($iconSrc) ?>" alt="" width="150">

                            <div>
                                <p id="username">ユーザー名</p>
                                <p id="username-body"><?php echo ($result["username"]) ?></p><br>
                                <p id="comment">一言コメント</p>
                                <p id="comment-body"><?php echo ($result["uComment"]) ?></p>
                            </div>
                        </div>

                        <h2>投稿一覧（<?php echo (count($ar)) ?>）</h2>

                        <div id="article-container">

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

                            <div class="article" data-aid="<?php echo ($ar[$i]["articleID"]) ?>">
                                <a href="view.php?v=<?php echo ($ar[$i]["articleID"]) ?>">
                                    <?php if ($src) { ?>

                                    <img src="<?php echo ($src) ?>" alt="" height="200">

                                    <?php } else { ?>

                                    <div class="no-image">No image</div>

                                    <?php } ?>
                                </a>
                                <table class="article-info">
                                    <tbody>
                                        <tr>
                                            <th nowrap>聖地名</th>
                                            <td><?php echo ($ar[$i]["name"]) ?></td>
                                        </tr>
                                        <tr>
                                            <th nowrap>作品名</th>
                                            <td><?php echo ($wr["title"]) ?></td>
                                        </tr>
                                        <tr>
                                            <th nowrap>住　所</th>
                                            <td><?php echo ($ar[$i]["sAddress1"] . $ar[$i]["sAddress2"] . $ar[$i]["sAddress3"]) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th nowrap>詳　細</th>
                                            <td><?php echo ($ar[$i]["details"]) ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="article-footer">
                                    <span class="article-info go">行きたい <?php echo ($ar[$i]["go"]) ?></span>
                                    <span class="article-delete unimp">削除</span>
                                    <span class="article-edit">編集</span>
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

                <div id="version"><?php echo ($ini["version"]) ?></div>

            </footer>

        </div>
    </div>
</body>

</html>