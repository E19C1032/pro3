<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">

    <script src="js/include/util.js?202111221630"></script>
    <script src="js/resettingPassword.js?202111221630"></script>
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

                    </ul>
                </div>

            </header>
        </div>
        <div id="container">


            <main>
                <div id="main-container">
                    <form action="sendEmail.php" method="POST" name="formResettingPassword">
                        <label for="email-address">メールアドレス</label>
                        <input type="text" id="email-address" name="emailAddress" value="">
                        <input type="hidden" name="emailSubject" value="【SEITI】パスワード再設定のお知らせ">
                        <input type="hidden" name="emailBody" value="新しいパスワード\r\n<?php echo $password ?>">
                        <input type="hidden" name="password" value="<?php echo $password ?>"><br>

                        <button type="button" id="button-submit">送信</button>
                    </form>
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