<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>記事閲覧 - SEITI</title>

    <link rel="stylesheet" href="css/view.css?202110211251">
    <style>
    #map {
        width: 480px;
        height: 320px;
    }
    </style>

    <script src="http://maps.google.com/maps/api/js?key=AIzaSyD1IppMdLlsPjuGuUGZWQviMmc2brYPARo&language=ja"></script>
    <script>
    <?php if ($login) { ?>

    const uid = <?php echo $userID ?>;

    <?php } ?>
    </script>
    <script src="js/include/util.js"></script>
    <script src="js/view.js?202110221600"></script>
</head>

<body>

    <div id="container">

        <header>

            <a href="top.php">
                <h1>SEITI</h1>
            </a>

        </header>

        <main>

            <div id="main-container">

                <!-- 記事が見つからなかった場合 -->
                <?php if ($nf) { ?>

                <p>対象の記事は存在しない、もしくは削除された可能性があります。</p>

                <?php } else { ?>

                <div id="container-info">
                    <h2>記事情報</h2>

                    <!-- Google Map -->
                    <div id="map" width="480" height="320"></div>

                    <?php

                            $src = readImageToBase64("./image/" . $result["image"]);

                            if ($src) {

                                ?>

                    <img src="<?php echo $src ?>">

                    <?php } else { ?>

                    <div class="no-image">No image</div>

                    <?php } ?>
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
                            
                        ?>" data-aid="<?php echo $articleID ?>">行きたい<?php echo $result["go"] ?></button>
                        <button id="button-favorite" data-push="<?php
                            
                            if ($far) {
                                echo "true";
                            } else {
                                echo "false";
                            } 
                            
                        ?>" data-aid="<?php echo $articleID ?>">お気に入り</button>
                        <button id="button-report" class="unimp">通報</button>
                    </div>
                </div>

                <div id="button-post-comment">コメント</div>

                <div id="post-comment-container">
                    <form action="postComment.php?aid=<?php echo $result["articleID"] ?>" method="POST"
                        name="formComment" enctype="multipart/form-data">

                        <label for="textarea-form-comment">コメント</label><br>
                        <textarea name="formCommentComment" id="textarea-form-comment" cols="24"
                            rows="10"></textarea><br>
                        <label for="input-image">画像を選択</label><br>
                        <input type="file" accept="image/png, image/jpeg" name="formCommentImage" id="input-image"><br><br>
                        <span id="button-form-comment-cancel">キャンセル</span>
                        <span id="button-form-comment-submit">送信</span><br>
                    </form>
                </div>

                <div id="container-comments">
                    <h2>コメント（<?php echo count($cr) ?>）</h2>

                    <?php

                            for ($i = 0; $i < count($cr); $i++) {
                                // ユーザー情報
                                // ur: User Result
                                $sql = "SELECT userID, username, icon FROM user WHERE userID = " . $cr[$i]["userID"] . ";";
                                $ur = $conn->query($sql)->fetch();

                                // アイコンが設定されていないならば初期アイコンを表示
                                if ($ur["icon"] == null) {
                                    $filename = "default_icon.png";
                                } else {
                                    $filename = $ur["icon"];
                                }

                                if ($iconSrc = readImageToBase64("./icon/" . $filename));

                                ?>

                    <div class="comment">
                        <div>

                            <a href="mypage.php?uid=<?php echo $ur["userID"] ?>">
                                <img class="user-icon" src="<?php echo $iconSrc ?>" width="100" height="100">
                            </a>
                            <div>
                                <div class="username">
                                    <p>アカウント名</p><?php echo $ur["username"] ?>
                                </div><br>
                                <div class="comment-body">
                                    <p>コメント</p><?php echo $cr[$i]["comment"] ?>
                                </div>
                            </div>
                        </div>
                        <?php if ($cr[$i]["image"] == null) { ?>



                        <?php

                        } else {
                            if ($imageSrc = readImageToBase64("./image/" . $cr[$i]["image"]));

                        ?>
                        
                        <img class="comment-image" src="<?php echo $imageSrc ?>">

                        <?php } ?>
                    </div>

                    <?php } ?>
                </div>

                <?php } ?>

            </div>

        </main>

    </div>

    <script src="js/map.js?202110251744"></script>

</body>

</html>