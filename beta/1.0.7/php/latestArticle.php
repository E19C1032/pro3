<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>最新記事一覧 - SEITI</title>

    <link rel="stylesheet" href="css/latestArticle.css?202110221703">

    <script>
    <?php if ($login) { ?>

    const uid = <?php echo $userID ?>;

    <?php } ?>
    </script>
    <script src="js/latestArticle.js?202110221708"></script>
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

                        <!-- 未ログイン時 -->
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

                <h2>最新記事一覧（最新<?php echo count($result) ?>件）</h2>

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

                        if($login) {
                            $sql = "SELECT * FROM favoriteArticle WHERE userID = " . $userID . " AND articleID = " . $result[$i]["articleID"] . ";";
                            $far = $conn->query($sql)->fetch();
                        }

                        ?>

                    <div class="article">
                        <div class="article-header">
                            <img src="<?php echo $iconSrc ?>" width="50">
                            <span class="username"><?php echo $ur["username"] ?></span>
                        </div>
                        <div class="article-body">
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

                                    <div class="no-image">No image</div>

                                    <?php } ?>
                                </div>
                            </a>

                            <div class="article-date"><?php echo $result[$i]["date"] ?></div>
                        </div>
                        <div class="article-info">
                            <table>
                                <tbody>
                                    <tr>
                                        <th nowrap>聖地名</th>
                                        <td><?php echo $result[$i]["name"] ?></td>
                                    </tr>
                                    <tr>
                                        <th nowrap>作品名</th>
                                        <td><?php echo $wr["title"] ?></td>
                                    </tr>
                                    <tr>
                                        <th nowrap>住所</th>
                                        <td><?php echo $result[$i]["sAddress1"] . $result[$i]["sAddress2"] . $result[$i]["sAddress3"] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th nowrap>聖地詳細</th>
                                        <td><?php 
                                        
                                        if ($result[$i]["details"] == null) {
                                            echo "なし";
                                        } else {
                                            echo $result[$i]["details"];
                                        }
                                        
                                        ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="button-favorite" data-push="<?php
                            
                            if($far) {
                                echo "true";
                            } else {
                                echo "false";
                            }
                            
                            ?>" data-aid="<?php echo $result[$i]["articleID"] ?>">お気に入り</button>
                        </div>
                    </div>

                    <?php } ?>

                </div>

            </main>
        </div>
    </div>

</body>

</html>