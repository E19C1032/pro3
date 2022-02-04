<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>トップ - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">
</head>

<body>

    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <img src="wp_contents/image/logo.png" alt="">
                </a>
                <div>
                    <ul>
                        <a href="reportedArticle.php">
                            <li>報告記事一覧</li>
                        </a>
                        <a href="latestArticle.php">
                            <li>最新記事一覧</li>
                        </a>
                    </ul>
                </div>
                <div></div>
            </header>
        </div>

        <div id="container">
            <main>

                <div id="main-container">
                    <div id="container-host">
                        <h2>ホスト</h2>

                        <div>
                            <h2>ユーザー累計報告数</h2>

                            <table>
                                <thead>
                                    <tr>
                                        <td>ユーザー名</td>
                                        <td>累計報告数</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    for($i = 0; $i < count($report); $i++) { 
                                        $sql = "
                                            SELECT username 
                                            FROM user 
                                            WHERE
                                                userID = ?;
                                        ";
                                        $username = execsql($conn, $sql, array($report[$i]["userID"]))->fetch()["username"];
                                        
                                    ?>

                                    <tr>
                                        <td>

                                            <?php echo $username ?>

                                        </td>
                                        <td>

                                            <?php echo $report[$i]["count"] ?>

                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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