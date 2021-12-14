<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202112141602">

    <script src="js/include/util.js?202112141602"></script>
    <script src="js/changePassword.js?202112141602"></script>
</head>

<body>
    <div class="popup-changePassword">
        <div class="content">
            <div class="content-image">
                <img src="wp_contents/image/image05.svg" alt="">
            </div>
            <h2>パスワードを変更しました</h2>
            <div class="content-button">
                <button id="close">完了する</button>
            </div>
        </div>
    </div>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <h1>SEITI</h1>
                </a>
                <div>
                    <ul>
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>
                    </ul>
                </div>
                <div></div>
            </header>
        </div>
        <div id="container">


            <main>
                <div id="main-container">
                    <div id="container-changePassword">
                        <h2>パスワード変更</h2>

                        <form action="updatePassword.php" method="POST" name="formPost">
                            <fieldset>
                                <div>
                                    <div>現在のパスワード</div>
                                    <input type="password" id="form-now-password" name="formNowPassword">
                                </div>

                                <div>
                                    <div>新しいパスワード</div>
                                    <input type="password" id="form-new-password" name="formNewPassword">
                                </div>

                                <div>
                                    <div>
                                        新しいパスワード
                                        <p>確認用</p>
                                    </div>
                                    <input type="password" id="form-new-password2" name="formNewPassword2">
                                </div>
                            </fieldset>
                        </form>
                        <div class="form-bottom">
                            <button id="buttonBack" type="button">戻る</button>
                            <button id="buttonSubmit" type="button">変更</button>
                            <div></div>
                        </div>
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