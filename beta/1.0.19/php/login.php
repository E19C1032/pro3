<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202112141602">

    <script src="js/include/util.js?202112141602"></script>
    <script src="js/login.js?202112141602"></script>
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
                    </ul>
                </div>
                <div>
                    <a href="login.php">
                        ログイン
                    </a>
                </div>

            </header>
        </div>
        <div id="container">

            <main>
                <div id="main-container">
                    <div id="container-login">
                        <h2>ログイン</h2>
                        <form action="auth.php" method="POST" name="formLogin">
                            <fieldset>

                                <table>
                                    <tr>
                                        <th>
                                            <label class="form-label">メールアドレス*</label>
                                        </th>
                                        <td>
                                            <input type="text" name="mailAddress">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label class="form-label">パスワード*</label>
                                        </th>
                                        <td>
                                            <input type="password" name="password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <td>

                                        </td>
                                    </tr>
                                </table>
                                <button type="button" id="button-login">ログイン</button>

                                <!-- ログイン失敗時 -->
                                <?php if ($loginFalse) { ?>

                                <p>ログインに失敗しました。</p>

                                <?php } ?>
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
    </div>
</body>

</html>