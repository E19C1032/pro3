<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更 - SEITI</title>

    <link rel="stylesheet" href="css/changePassword.css?202110211622">

    <script src="js/include/util.js"></script>
    <script src="js/changePassword.js?202110221515"></script>
</head>

<body>

    <div id="container">

        <header>



        </header>
        <h2>パスワード変更</h2>
        <main>

            <form action="updatePassword.php" method="POST" name="formPost">
                <div>
                    <label for="form-now-password">現在のパスワード</label>
                    <input type="text" id="form-now-password" name="formNowPassword">
                </div>

                <div>
                    <label for="form-new-password">新しいパスワード</label>
                    <input type="text" id="form-new-password" name="formNewPassword">
                </div>

                <div>
                    <label for="form-new-password2">新しいパスワード（確認用）</label>
                    <input type="text" id="form-new-password2" name="formNewPassword2">
                </div>

                <button id="buttonBack" type="button">戻る</button>
                <button id="buttonSubmit" type="button">変更</button>
            </form>

        </main>

    </div>

</body>

</html>