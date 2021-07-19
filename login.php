<?php

// ログインが失敗したかどうかをurlパラメータで判断
$loginFalse = false;
if(isset($_GET["login"])) {
    $loginFalse = true;
}

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ログイン - SEITI</title>

        <link rel="stylesheet" href="css/common.css?20210713">

        <script src="js/checkBlank.js"></script>
        <script src="js/login.js"></script>
    </head>
    <body>
        
        <header>

            <a href="top.php"><h1>SEITI</h1></a>
            <a href="create_account.php">アカウント作成</a>

        </header>

        <hr>

        <main>

            <form action="auth.php" method="POST" name="formLogin">
                <fieldset>
                    <legend>ログイン</legend>

                    <label class="form-label">メールアドレス*</label><input type="text" name="mailAddress"><br>
                    <label class="form-label">パスワード*</label><input type="password" name="password"><br>

                    <button type="button" id="button-login">ログイン</button>

                    <!-- ログイン失敗時 -->
                    <?php if($loginFalse) { ?>
                    
                    <p style="color: #ff0000;">ログインに失敗しました。</p>
                    
                    <?php } ?>
                </fieldset>
            </form>

        </main>

        <footer>



        </footer>

    </body>
</html>