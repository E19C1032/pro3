<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>お気に入り記事一覧 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">
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

                        <?php } ?>
                    </ul>
                </div>

            </header>
        </div>
        <div id="container">
            <main>
                <div id="main-container">
                    <div id="container-favoriteArticle">
                        <h2>お気に入り一覧（最新<?php echo count($far) ?>件）</h2>

                        <div id="articles-container">
                            <?php

                            for ($i = 0; $i < count($far); $i++) {
                                // お気に入り記事
                                $sql = "SELECT * FROM article WHERE articleID = " . $far[$i]["articleID"] . ";";
                                $result = $conn->query($sql)->fetch();

                                // 作品タイトル
                                // wr: Work Result
                                $sql = "SELECT title FROM work WHERE workID = " . $result["workID"] . ";";
                                $wr = $conn->query($sql)->fetch();

                                // ユーザー情報
                                // ur: User Result
                                $sql = "SELECT username, icon FROM user WHERE userID = " . $result["userID"] . ";";
                                $ur = $conn->query($sql)->fetch();

                                if ($ur["icon"] == null) {
                                    $filename = "default_icon.png";
                                } else {
                                    $filename = $ur["icon"];
                                }

                                $iconSrc = readImageToBase64("./icon/" . $filename);
                                $imageSrc = readImageToBase64("./image/" . $result["image"]);
                                $imageWidth = getImageWidth("./image/" . $result["image"]);
                                $imageHeight = getImageHeight("./image/" . $result["image"]);
                                ?>

                            <div class="article">

                                <div class="article-image">
                                    <a href="view.php?v=<?php echo $result["articleID"] ?>">
                                        <div class="image-container">
                                            <?php if ($imageSrc) { ?>

                                            <img src="<?php echo $imageSrc ?>" alt="" <?php

                                                                                                        if ($imageWidth > $imageHeight) {
                                                                                                            echo "width=\"300\"";
                                                                                                        } else {
                                                                                                            echo "height=\"300\"";
                                                                                                        }

                                                                                                        ?>>

                                            <?php } else { ?>

                                                <img src="<?php echo $noimage ?>" alt="no image">

                                            <?php } ?>
                                        </div>
                                    </a>

                                    <div class="article-date"><?php echo $result["date"] ?></div>
                                </div>
                                <div class="article-content">
                                    <div class="article-user">
                                        <img src="<?php echo $iconSrc ?>" width="50">
                                        <span class="username"><?php echo $ur["username"] ?></span>
                                    </div>
                                    <div class="article-info">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th nowrap>聖地名</th>
                                                    <td><?php echo $result["name"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th nowrap>作品名</th>
                                                    <td><?php echo $wr["title"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th nowrap>住所</th>
                                                    <td><?php echo $result["sAddress1"] . $result["sAddress2"] . $result["sAddress3"] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th nowrap>聖地詳細</th>
                                                    <td><?php if ($result["details"] == null) {
                                                                echo "なし";
                                                            } else {
                                                                echo $result["details"];
                                                            } ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php

                                if ($i == 7) break;
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