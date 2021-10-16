<?php

require "include/readIni.php";
require "include/pdoConnect.php";
require "include/util.php";

session_start();

// 最新記事８件
$sql = "SELECT * FROM article ORDER BY date DESC LIMIT 8;";
$result = $conn->query($sql)->fetchAll();

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>最新記事一覧 - SEITI</title>

        <link rel="stylesheet" href="css/common.css">
    </head>
    <body>
        
        <div id="container">

            <header>

                <a href="top.php"><h1>SEITI</h1></a>

            </header>

            <main>
                
                <h2>最新記事一覧（最新<?php echo(count($result)) ?>件）</h2>

                <div id="articles-container">
                    <?php
                    
                    for($i = 0; $i < count($result); $i++) {
                        // 作品タイトル
                        // wr: Work Result
                        $sql = "SELECT title FROM work WHERE workID = ".$result[$i]["workID"].";";
                        $wr = $conn->query($sql)->fetch();

                        // ユーザー情報
                        // ur: User Result
                        $sql = "SELECT username, icon FROM user WHERE userID = ".$result[$i]["userID"].";";
                        $ur = $conn->query($sql)->fetch();

                        if($ur["icon"] == null) {
                            $filename = "default_icon.png";
                        } else {
                            $filename = $ur["icon"];
                        }

                        $iconSrc = readImageToBase64("./icon/".$filename);
                        $imageSrc = readImageToBase64("./image/".$result[$i]["image"]);
                        $imageWidth = getImageWidth("./image/".$result[$i]["image"]);
                        $imageHeight = getImageHeight("./image/".$result[$i]["image"]);
                    ?>
                    
                    <div class="article">
                        <div class="article-header">
                            <img src="<?php echo($iconSrc) ?>" width="50">
                            <span class="username"><?php echo($ur["username"]) ?></span>
                        </div>
                        <div class="article-body">
                            <a href="view.php?v=<?php echo($result[$i]["articleID"]) ?>">
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

                            <div class="article-date"><?php echo($result[$i]["date"]) ?></div>
                        </div>
                        <div class="article-info">
                            <table>
                                <tbody>
                                    <tr>
                                        <th nowrap>聖地名</th><td><?php echo($result[$i]["name"]) ?></td>
                                    </tr>
                                    <tr>
                                        <th nowrap>作品名</th><td><?php echo($wr["title"]) ?></td>
                                    </tr>
                                    <tr>
                                        <th nowrap>住所</th><td><?php echo($result[$i]["sAddress1"].$result[$i]["sAddress2"].$result[$i]["sAddress3"]) ?></td>
                                    </tr>
                                    <tr>
                                        <th nowrap>聖地詳細</th><td><?php if($result[$i]["details"] == null) { echo("なし"); } else { echo($result[$i]["details"]); } ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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