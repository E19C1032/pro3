<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/search.css??202110211207">
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
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>


                        <?php } else { ?>
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
            <div id="main">

                <input type="text" id="input-search"><br>

                <?php

                for ($i = 0; $i < count($wrArray); $i++) {
                    $keys = array_keys($wrArray);

                    ?>

                <h3><?php echo $keys[$i] ?></h3>

                <?php

                        for ($j = 1; $j < count($wrArray[$keys[$i]]); $j++) {
                            $workID = $wrArray[$keys[$i]][$j]["workID"];
                            $title = $wrArray[$keys[$i]][$j]["title"];
                            $titlePseudonym = $wrArray[$keys[$i]][$j]["titlePseudonym"]

                            ?>

                <a
                    href="article.php?workID=<?php echo $workID ?>"><?php echo $title . "（" . $titlePseudonym . "）" ?></a><br>

                <?php

                    }
                }

                ?>

            </div>
            <div id="aside">
                <div id="pr">
                    <h2>人気タイトル</h2>
                    <ol>
                        <?php

                        for ($i = 0; $i < count($pr); $i++) {
                            $sql = "SELECT workID, title, titlePseudonym FROM work WHERE workID = " . $pr[$i]["workID"] . ";";
                            $result = $conn->query($sql)->fetch();

                            ?>

                        <li><a
                                href="article.php?workID=<?php echo $result["workID"] ?>"><?php echo $result["title"] . "（" . $result["titlePseudonym"] . "）" ?></a>
                        </li>

                        <?php } ?>
                    </ol>

                </div>
                <div id="lr">
                    <h2>最新記事</h2>
                    <ul>
                        <?php for ($i = 0; $i < count($lr); $i++) { ?>

                        <li><a href="view.php?v=<?php echo $lr[$i]["articleID"] ?>"><?php echo $lr[$i]["name"] ?></a>
                        </li>

                        <?php } ?>
                    </ul>
                </div>
                <?php if ($login) { ?>
                <div id="fr">
                    <h2>お気に入り記事</h2>
                    <ul>
                        <?php

                                for ($i = 0; $i < count($fr); $i++) {
                                    $sql = "SELECT articleID, name FROM article WHERE articleID = " . $fr[$i]["articleID"] . ";";
                                    $result = $conn->query($sql)->fetch();

                                    ?>

                        <li><a href="view.php?v=<?php echo $result["articleID"] ?>"><?php echo $result["name"] ?></a>
                        </li>

                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>