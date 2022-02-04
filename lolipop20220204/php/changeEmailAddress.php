<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メールアドレス変更 - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">

    <script src="js/include/util.js?202112141602"></script>
    <script src="js/changeEmailAddress.js?202112141602"></script>
    <?php if(isset($_GET["error"]) && $_GET["error"] == 1) { ?>
    
    <script>

    window.addEventListener("load", () => {
        alert("現在のメールアドレスが正しくありません。");
        location = location.origin + location.pathname;
    });

    </script>

    <?php } ?>
</head>

<body>
    <div class="popup-changeEmailAddress">
        <div class="content">
            <div class="content-image">
                <img src="wp_contents/image/image03.svg" alt="">
            </div>
            <h2>メールアドレスを変更しました</h2>
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
                    <div id="container-changeEmailAddress">
                        <h2>メールアドレス変更</h2>
                        <form action="updateEmailAddress.php" method="POST" name="formPost">
                            <fieldset>
                                <div>
                                    <div>現在のメールアドレス</div>
                                    <input type="text" id="form-now-email-address" name="formNowEmailAddress">
                                </div>
                                <div>
                                    <div>新しいメールアドレス</div>
                                    <input type="text" id="form-new-email-address" name="formNewEmailAddress">
                                </div>
                                <div>
                                    <div>新しいメールアドレス(確認用)

                                    </div>
                                    <input type="text" id="form-new-email-address2" name="formNewEmailAddress2">
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