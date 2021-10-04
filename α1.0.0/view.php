<?php

require "include/readIni.php";
require "include/pdoConnect.php";
require "include/util.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

// 対象の記事情報を取得
$articleID = $_GET["v"];
$nf = false;

// 無効な記事？
if($articleID == "NF") {
    $nf = true;
} else {
    // 対象の記事を取得
    $sql = "SELECT * FROM article WHERE articleID = ".$articleID.";";
    $result = $conn->query($sql)->fetch();
    if(!$result) {
        header("Location:view.php?v=NF");
    }

    // 作品名を取得
    // wr: Work Result
    $sql = "SELECT title FROM work WHERE workID = ".$result["workID"].";";
    $wr = $conn->query($sql)->fetch();

    // コメントを取得
    // cr: Comment Reasult
    $sql = "SELECT * FROM comment WHERE articleID = ".$articleID.";";
    $cr = $conn->query($sql)->fetchAll();

    // ログイン時
    // uaar: User and Article Result
    // far: Favorite Article Result
    if($login) {
        $sql = "SELECT * FROM go WHERE userID = ".$userID." AND articleID = ".$articleID.";";
        $uaar = $conn->query($sql)->fetch();

        $sql = "SELECT * FROM favoriteArticle WHERE userID = ".$userID." AND articleID = ".$articleID.";";
        $far = $conn->query($sql)->fetch();
    }
}

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>記事閲覧 - SEITI</title>

        <link rel="stylesheet" href="css/common.css?202107151802">

        <script>

            <?php if($login) { ?>

            const uid = <?php echo($userID) ?>;
            const aid = <?php echo($articleID) ?>;

            <?php } ?>

        </script>
        <script src="js/include/util.js"></script>
        <script src="js/view.js?202107211156"></script>
    </head>
    <body>
        
        <div id="container">

            <div id="bg">
                <!-- <img src="img_contents/loading.gif" alt=""> -->
            </div>

            <header>

                <a href="top.php"><h1>SEITI</h1></a>

                <hr>

            </header>

            <main>

                <div id="main-container">

                    <!-- 記事が見つからなかった場合 -->
                    <?php if($nf) { ?>
                    
                    <p>対象の記事は存在しない、もしくは削除された可能性があります。</p>

                    <?php } else { ?>

                    <div id="container-info">
                        <h2>記事情報</h2>
                        <table id="article-info">
                            <tbody>
                                <tr>
                                    <th>聖地名</th>
                                    <td><?php echo($result["name"]) ?></td>
                                </tr>
                                <tr>
                                    <th>作品名</th>
                                    <td><?php echo($wr["title"]) ?></td>
                                </tr>
                                <tr>
                                    <th>住　所</th>
                                    <td><?php echo($result["sAddress1"].$result["sAddress2"].$result["sAddress3"]) ?></td>
                                </tr>
                                <tr>
                                    <th>詳　細</th>
                                    <td>
                                        <?php 
                                        
                                        if($result["details"] == null) {
                                            echo("なし");
                                        } else {
                                            echo($result["details"]);
                                        }
                                        
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?php
                        
                        $src = readImageToBase64("./image/".$result["image"]);

                        if($src) {

                        ?>

                        <img src="<?php echo($src) ?>">

                        <?php } else { ?>

                        <div class="no-image">No image</div>
                        
                        <?php } ?>

                        <div id="button-container">
                            <button id="button-go" data-push="<?php if($uaar) echo("true"); else echo("false"); ?>">行きたい <?php echo($result["go"]) ?></button>
                            <button id="button-favorite" data-push="<?php if($far) echo("true"); else echo("false"); ?>">お気に入り</button>
                            <button id="button-report" class="unimp">通報</button>
                        </div>
                    </div>

                    <div id="button-post-comment">コメント</div>

                    <div id="post-comment-container">
                        <form action="postComment.php?aid=<?php echo($result["articleID"]) ?>" method="POST" name="formComment" enctype="multipart/form-data">
                            <span id="button-form-comment-cancel">キャンセル</span>
                            <span id="button-form-comment-submit">送信</span><br>

                            <label for="textarea-form-comment">コメント</label>
                            <textarea name="formCommentComment" id="textarea-form-comment" cols="24" rows="10"></textarea>
                            <label for="input-image">画像を選択</label>
                            <input type="file" accept="image/*" name="formCommentImage" id="input-image">
                        </form>
                    </div>

                    <div id="container-comments">
                        <h2>コメント（<?php echo(count($cr)) ?>）</h2>

                        <?php
                        
                        for($i = 0; $i < count($cr); $i++) {
                            // ユーザー情報
                            // ur: User Result
                            $sql = "SELECT username, icon FROM user WHERE userID = ".$cr[$i]["userID"].";";
                            $ur = $conn->query($sql)->fetch();

                            // アイコンが設定されていないならば初期アイコンを表示
                            if($ur["icon"] == null) {
                                $filename = "default_icon.png";
                            } else {
                                $filename = $ur["icon"];
                            }

                            if($iconSrc = readImageToBase64("./icon/".$filename));
                            
                        ?>

                        <div class="comment">
                            <img class="user-icon" src="<?php echo($iconSrc) ?>" width="100" height="100">
                            <div class="username"><?php echo($ur["username"]) ?></div>
                            <div class="comment-body"><?php echo($cr[$i]["comment"]) ?></div>
                            <?php if($cr[$i]["image"] == null) { ?>



                            <?php
                            
                            } else {
                                if($imageSrc = readImageToBase64("./image/".$cr[$i]["image"]));
                                
                            ?>

                            <img class="comment-image" src="<?php echo($imageSrc) ?>">

                            <?php } ?>
                        </div>

                        <?php } ?>
                    </div>

                    <?php } ?>

                </div>

            </main>

            <footer>

                <div id="version"><?php echo($ini["version"]) ?></div>

            </footer>

        </div>

    </body>
</html>