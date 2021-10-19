<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>メールアドレス変更 - SEITI</title>

        <link rel="stylesheet" href="css/common.css">

        <script src="js/include/util.js"></script>
        <script src="js/changeEmailAddress.js"></script>
    </head>
    <body>
        
        <div id="container">

            <header>



            </header>

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

            <footer>

                <div id="version"><?php echo ($ini["version"]) ?></div>

            </footer>

        </div>

    </body>
</html>