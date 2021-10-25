<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メールアドレス変更 - SEITI</title>

    <link rel="stylesheet" href="css/changeEmailAddress.css?202110211622">

    <script src="js/include/util.js"></script>
    <script src="js/changeEmailAddress.js?202110221432"></script>
</head>

<body>

    <div id="container">

        <header>



        </header>
        <h2>メールアドレス変更</h2>
        <main>

            <form action="updateEmailAddress.php" method="POST" name="formPost">
                <div>
                    <label for="form-now-email-address">現在のメールアドレス</label>
                    <input type="text" id="form-now-email-address" name="formNowEmailAddress">
                </div>

                <div>
                    <label for="form-new-email-address">新しいメールアドレス</label>
                    <input type="text" id="form-new-email-address" name="formNewEmailAddress">
                </div>

                <div>
                    <label for="form-new-email-address2">新しいメールアドレス（確認用）</label>
                    <input type="text" id="form-new-email-address2" name="formNewEmailAddress2">
                </div>

                <button id="buttonBack" type="button">戻る</button>
                <button id="buttonSubmit" type="button">変更</button>
            </form>

        </main>

    </div>

</body>

</html>