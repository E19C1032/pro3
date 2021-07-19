<?php

require "pdo_connect.php";
require "util.php";

session_start();

// ログインしているかどうか
$login = false;
if(isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    $login = true;
}

if(!$login) {
    header("Location:login.php");
}

// お気に入り記事のIDを取得
// far: Favorite Article Result
$sql = "SELECT articleID FROM favoriteArticle WHERE userID = ".$userID.";";
$far = $conn->query($sql)->fetchAll();

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>お気に入り記事一覧 - SEITI</title>

        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/favoriteArticle.css">
    </head>
    <body>
        
        <header>

            <a href="top.php"><h1>SEITI</h1></a>

            <hr>

        </header>

        <main>

            <h2>最新記事一覧（最新<?php echo(count($far)) ?>件）</h2>

            <div id="articles-container">
                <?php
                
                for($i = 0; $i < count($far); $i++) {
                    // お気に入り記事
                    $sql = "SELECT * FROM article WHERE articleID = ".$far[$i]["articleID"].";";
                    $result = $conn->query($sql)->fetch();

                    // 作品タイトル
                    // wr: Work Result
                    $sql = "SELECT title FROM work WHERE workID = ".$result["workID"].";";
                    $wr = $conn->query($sql)->fetch();

                    // ユーザー情報
                    // ur: User Result
                    $sql = "SELECT username, icon FROM user WHERE userID = ".$result["userID"].";";
                    $ur = $conn->query($sql)->fetch();

                    if($ur["icon"] == null) {
                        $filename = "default_icon.png";
                    } else {
                        $filename = $ur["icon"];
                    }

                    $iconSrc = readImageToBase64("./icon/".$filename);
                    $imageSrc = readImageToBase64("./image/".$result["image"]);
                    $imageWidth = getImageWidth("./image/".$result["image"]);
                    $imageHeight = getImageHeight("./image/".$result["image"]);
                ?>
                
                <div class="article">
                    <div class="article-header">
                        <img src="<?php echo($iconSrc) ?>" width="50">
                        <span class="username"><?php echo($ur["username"]) ?></span>
                    </div>
                    <div class="article-body">
                        <a href="view.php?v=<?php echo($result["articleID"]) ?>">
                            <div class="image-container">
                                <?php if($imageSrc) { ?>

                                <img src="<?php echo($imageSrc) ?>" alt=""
                                
                                <?php
                                
                                if($imageWidth > $imageHeight) {
                                    echo("width=\"100%\"");
                                } else {
                                    echo("height=\"100%\"");
                                }
                                    
                                ?>

                                >

                                <?php } else { ?>

                                <div class="no-image">No image</div>

                                <?php }?>
                            </div>
                        </a>

                        <div class="article-date"><?php echo($result["date"]) ?></div>
                    </div>
                    <div class="article-info">
                        <table>
                            <tbody>
                                <tr>
                                    <th nowrap>聖地名</th><td><?php echo($result["name"]) ?></td>
                                </tr>
                                <tr>
                                    <th nowrap>作品名</th><td><?php echo($wr["title"]) ?></td>
                                </tr>
                                <tr>
                                    <th nowrap>住所</th><td><?php echo($result["sAddress1"].$result["sAddress2"].$result["sAddress3"]) ?></td>
                                </tr>
                                <tr>
                                    <th nowrap>聖地詳細</th><td><?php if($result["details"] == null) { echo("なし"); } else { echo($result["details"]); } ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php 
            
                    if($i == 7) break;
                }
                
                ?>

            </div>

        </main>

        <footer>



        </footer>

    </body>
</html>