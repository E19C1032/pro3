<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202110251622">

    <script src="js/include/util.js"></script>
    <script src="js/changePassword.js?202110221515"></script>
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

                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>


                        <?php } else { ?>

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

                        <?php } ?>
                    </ul>
                </div>

            </header>
        </div>
        <div id="container">


            <main>
                <div id="main-container">
                    <div id="container-changePassword">
                        <h2>パスワード変更</h2>

                        <form action="updatePassword.php" method="POST" name="formPost">
                            <fieldset>
                                <table>
                                    <tr>
                                        <td><label for="form-now-password">現在のパスワード</label></td>
                                        <td><input type="password" id="form-now-password" name="formNowPassword"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="form-new-password">新しいパスワード</label></td>
                                        <td><input type="password" id="form-new-password" name="formNewPassword"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="form-new-password2">新しいパスワード（確認用）</label></td>
                                        <td><input type="password" id="form-new-password2" name="formNewPassword2"></td>
                                    </tr>
                                </table>
                                <button id="buttonBack" type="button">戻る</button>
                                <button id="buttonSubmit" type="button">変更</button>
                            </fieldset>
                        </form>

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