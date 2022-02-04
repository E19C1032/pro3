<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>トップ - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">

    <script src="js/reportedArticle.js?202112141602"></script>
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="host.php">
                    <img src="wp_contents/image/logo.png" alt="">
                </a>
                <div>
                    <ul>
                        <a href="host.php">
                            <li>ホスト</li>
                        </a>
                    </ul>
                </div>
                <div></div>
            </header>
        </div>

        <div id="container">
            <main>

                <div id="main-container">
                    <div id="container-reportedArticle">
                        <h2>報告記事一覧</h2>
                        <select name="selectSort" id="select-sort">
                            <option value="count">報告数</option>
                            <option value="date">報告日時</option>
                        </select>
                        <table border="1">
                            <thead>
                                <tr>
                                    <td>報告数</td>
                                    <td>報告種別</td>
                                    <td>報告者</td>
                                    <td>聖地名</td>
                                    <td>報告日時</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                for($i = 0; $i < count($result); $i++) { 
                                    // ユーザー名
                                    $sql = "
                                        SELECT username 
                                        FROM user 
                                        WHERE 
                                            userID = ?;
                                    ";
                                    $username = execsql($conn, $sql, array($result[$i]["userID"]))->fetch()["username"];

                                    // 聖地名
                                    $sql = "
                                        SELECT name 
                                        FROM article 
                                        WHERE 
                                            articleID = ?;
                                    ";
                                    $name = execsql($conn, $sql, array($result[$i]["articleID"]))->fetch()["name"];

                                    // 報告数
                                    $sql = "
                                        SELECT COUNT(*) 
                                        AS count 
                                        FROM reportedarticle 
                                        WHERE 
                                            articleID = ?;
                                    ";
                                    $count = execsql($conn, $sql, array($result[$i]["articleID"]))->fetch()["count"];
                                    
                                ?>

                                <tr class="report-row" data-count="<?php echo $count ?>"
                                    data-date="<?php echo $result[$i]["date"] ?>">
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $typeStr[$result[$i]["type"]] ?></td>
                                    <td><?php echo $username ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $result[$i]["date"] ?></td>
                                    <td><a href="view.php?v=<?php echo $result[$i]["articleID"] ?>&mode=host">記事</a>
                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
            <footer>
                <div id="footer-top">
                    <div>
                        <img src="wp_contents/image/logo_footer.png" alt="">
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>