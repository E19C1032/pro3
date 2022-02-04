<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>アカウント作成 - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">
    <style>
    tr,
    th,
    td {
        text-align: left;
        vertical-align: top;
    }

    input.err {
        border: 1px solid red;
    }

    .err-label {
        display: none;
    }

    input.err+.err-label {
        color: red;
        display: block;
    }
    </style>

    <script src="js/include/util.js?202112141602"></script>
    <script src="js/createAccount.js?202112141602"></script>
    <?php if(isset($_GET["error"]) && $_GET["error"] == 1) { ?>

    <script>

    window.addEventListener("load", () => {
        alert("このメールアドレスはすでに使用されています。");
        let username = "";
        if(getParam("username") != null)
            username = getParam("username");
        location = location.origin + location.pathname + "?username=" + username;
    });

    </script>

    <?php } ?>
</head>

<body>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <img src="wp_contents/image/logo.png" alt="">
                </a>
                <?php if ($login) { ?>
                <!-- ログイン時のメニュー -->
                <div>
                    <ul>
                        <a href="postArticle.php">
                            <li>投稿</li>
                        </a>
                        <a href="favoriteArticle.php">
                            <li>お気に入り記事</li>
                        </a>
                        <a href="latestArticle.php">
                            <li>最新記事一覧</li>
                        </a>
                        <a href="search.php">
                            <li>詳細検索</li>
                        </a>
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>
                    </ul>
                </div>
                <div>
                    <a href="logout.php">
                        ログアウト
                    </a>
                </div>

                <?php } else { ?>
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
                <?php } ?>
            </header>
        </div>
        <div id="container">

            <main>
                <div id="main-container">
                    <div id="container-createAccount">
                        <h2>アカウント作成</h2>
                        <form action="addUser.php" method="POST" name="formCreateAccount">
                            <fieldset>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <label class="form-label">ユーザー名</label>
                                            </th>
                                            <td>
                                                <input type="text" name="username" <?php if(isset($_GET["username"])) echo "value=\"" . $_GET["username"] . "\""; ?>>
                                                <p class="err-label">▽ユーザー名を入力してください</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label class="form-label">メールアドレス</label>
                                            </th>
                                            <td>
                                                <input type="text" name="mailAddress">
                                                <p class="err-label">▽メールアドレスを入力してください</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label class="form-label">パスワード</label>
                                                <p class="caution">※半角英数字の組み合わせ</p>
                                                <p class="caution">※記号使用可能</p>
                                                <p class="caution">/*-+.,!#$%&()~|_</p>
                                                <p class="caution">※8字~32字</p>
                                            </th>
                                            <td>
                                                <input type="password" name="password">
                                                <p class="err-label">▽正しいパスワードを入力してください</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label class="form-label">パスワード（確認用）</label>
                                            </th>
                                            <td>
                                                <input type="password" name="password2">
                                                <p class="err-label">▽正しいパスワード（確認用）を入力してください</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h2>利用規約</h2>
                                <textarea name="" id="" cols="30" rows="10" value="aaa"
                                    disabled><?php echo $termsOfUse ?></textarea><br>
                                <input type="checkbox" name="consent" id="input-consent"><label
                                    for="input-consent">利用規約に同意する</label><br>

                                <button type="button" id="button-create-account">アカウント作成</button>
                            </fieldset>
                        </form>
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
</body>

</html>