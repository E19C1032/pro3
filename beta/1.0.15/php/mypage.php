<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $result["username"] ?>さんのマイページ - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">

    <script src="js/mypage.js?202111221630"></script>
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>

                <a href="index.php">
                    <h1>SEITI</h1>
                </a>

                <div id="menu-container">

                    <ul>
                        <!-- ログイン時 -->
                        <?php if($login) { ?>

                        <a href="postArticle.php">
                            <li>投稿</li>
                        </a>
                        <a href="favoriteArticle.php">
                            <li>お気に入り記事一覧</li>
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

                        <?php } ?>

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

                    <div id="container-mypage">

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

                            <img src="<?php echo $iconSrc ?>" alt="" width="150">

                            <div>

                                <div>
                                    <p id="username">ユーザー名　</p>
                                    <p id="username-body"><?php echo $result["username"] ?></p>
                                </div>

                                <div>
                                    <p id="comment">一言コメント　</p>
                                    <p id="comment-body"><?php echo $result["uComment"] ?></p>
                                </div>

                            </div>
                        </div>

                        <h2>投稿一覧（<?php echo count($ar) ?>）</h2>

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
                                <div>
                                    <table class="article-info">
                                        <tbody>
                                            <tr>
                                                <th nowrap>聖地名</th>
                                                <td><?php echo $ar[$i]["name"] ?></td>
                                            </tr>
                                            <tr>
                                                <th nowrap>作品名</th>
                                                <td><?php echo $wr["title"] ?></td>
                                            </tr>
                                            <tr>
                                                <th nowrap>住　所</th>
                                                <td><?php echo $ar[$i]["sAddress1"] . $ar[$i]["sAddress2"] . $ar[$i]["sAddress3"] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th nowrap>詳　細</th>
                                                <td><?php echo $ar[$i]["details"] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="article-footer">
                                        <span class="article-info go">行きたい <?php echo $ar[$i]["go"] ?></span>
                                        <?php if($page == "me") { ?>

                                        <button class="button-remove"
                                            data-aid="<?php echo $ar[$i]["articleID"] ?>">削除</button>
                                        <button class="button-edit"
                                            data-aid="<?php echo $ar[$i]["articleID"] ?>">編集</button>

                                        <?php } ?>
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
</body>

</html>