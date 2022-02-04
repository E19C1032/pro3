<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>プロフィール変更 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202112141602">
    <style>
    #container-changeProfile div div img {
        height: 200px;
    }
    </style>
    <link rel="stylesheet" href="js/include/trimForIcon/trimForIcon.css">

    <script src="js/include/util.js?202112141602"></script>
    <script src="js/include/trimForIcon/trimForIcon.js"></script>
    <script src="js/changeProfile.js?202112212316"></script>
</head>

<body>
    <div id="container-trim-for-icon"></div>

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

                    <div id="container-changeProfile">
                        <h2>プロフィール変更</h2>
                        <form action="updateProfile.php" method="POST" name="formUpdateProfile">
                            <div class="p-top">
                                <div>
                                    <img id="user-icon" src="<?php echo $iconSrc ?>" alt="アイコン">

                                    <label for="form-user-icon">
                                        <img src="wp_contents/image/icon_change.png" alt="" class="changeIcon">
                                    </label>
                                    <input type="file" accept="image/png, image/jpeg" id="form-user-icon"
                                        name="formUserIcon">
                                    <input type="hidden" id="form-h-user-icon" name="formHUserIcon">
                                </div>
                                <div>
                                    <label for="">ユーザー名</label>
                                    <input type="text" id="form-username" name="formUsername"
                                        value="<?php echo $result["username"] ?>">
                                    <label for="">一言コメント</label>
                                    <textarea id="form-user-comment" name="formUserComment" cols="30"
                                        rows="10"><?php echo $result["uComment"] ?></textarea>
                                </div>
                            </div>
                            <div class="p-bottom">
                                <div>
                                    <button id="button-back" type="button">戻る</button>
                                </div>
                                <div>
                                    <button id="button-submit" type="button">変更を保存</button>
                                </div>
                                <div></div>
                            </div>
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