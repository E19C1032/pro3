<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更 - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">

    <script src="js/include/util.js?202112141602"></script>
    <script src="js/changePassword.js?202112141602"></script>
    <?php if(isset($_GET["error"]) && $_GET["error"] == 1) { ?>
    
    <script>

    window.addEventListener("load", () => {
        alert("現在のパスワードが正しくありません。");
        location = location.origin + location.pathname;
    });

    </script>

    <?php } ?>
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
                    <img src="wp_contents/image/logo.png" alt="">
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

                                <div class="caution-changePassword">
                                    <p>※半角英数字の組み合わせ</p>
                                    <p>※記号使用可能</p>
                                    <p>/*-+.,!#$%&()~|_</p>
                                    <p>※8字~32字</p>
                                </div>
                                <div>
                                    <div>
                                        新しいパスワード(確認用)
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