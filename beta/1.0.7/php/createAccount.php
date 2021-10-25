<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>アカウント作成 - SEITI</title>

    <link rel="stylesheet" href="css/createAccount.css?202110211622">

    <script src="js/include/util.js"></script>
    <script src="js/createAccount.js"></script>
</head>

<body>

    <div id="container">

        <header>

            <a href="top.php">
                <h1>SEITI</h1>
            </a>

        </header>

        <main>

            <form action="addUser.php" method="POST" name="formCreateAccount">
                <fieldset>
                    <legend>アカウント作成</legend>

                    <label class="form-label">ユーザー名*</label><input type="text" name="username"><br>
                    <label class="form-label">メールアドレス*</label><input type="text" name="mailAddress"><br>
                    <label class="form-label">パスワード*</label><input type="password" name="password"><br>
                    <label class="form-label">パスワード（確認用）*</label><input type="password" name="password2"><br>

                    <h2>利用規約</h2>
                    <textarea name="" id="" cols="30" rows="10" value="aaa"
                        disabled><?php echo $termsOfUse ?></textarea><br>
                    <input type="checkbox" name="consent" id="input-consent"><label
                        for="input-consent">利用規約に同意する</label><br>

                    <button type="button" id="button-create-account">アカウント作成</button>
                </fieldset>
            </form>

        </main>

        <footer>

            <div id="version"><?php echo $ini["version"] ?></div>

        </footer>

    </div>

</body>

</html>