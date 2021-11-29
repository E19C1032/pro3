<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>プロフィール変更 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">

    <script src="js/changeProfile.js?202111221630"></script>
</head>

<body>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <h1>SEITI</h1>
                </a>


                <div>
                    <ul>
                        <?php if ($login) { ?>

                        <!-- ログイン時のメニュー -->
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>


                        <?php } else { ?>

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
                        <a href="login.php">
                            <li>ログイン</li>
                        </a>

                        <?php } ?>
                    </ul>
                </div>

            </header>
        </div>
        <div id="container">

            <main>
                <div id="main-container">
                    <h2>プロフィール変更</h2>
                    <div id="container-changeProfile">

                        <div>
                            <img id="user-icon" src="<?php echo $iconSrc ?>" alt="アイコン">
                            <canvas id="upload-icon" width="320" height="320"></canvas>
                            <br>

                        </div>
                        <form action="updateProfile.php" method="POST" name="formUpdateProfile">
                            <input type="file" accept="image/png, image/jpeg" id="form-user-icon" name="formUserIcon">
                            <input type="hidden" id="form-h-user-icon" name="formHUserIcon">
                            <br>
                            <br>
                            <label for="">ユーザー名</label>
                            <input type="text" id="form-username" name="formUsername"
                                value="<?php echo $result["username"] ?>">
                            <br>
                            <label for="">一言コメント</label>
                            <textarea id="form-user-comment" name="formUserComment" cols="30"
                                rows="10"><?php echo $result["uComment"] ?></textarea>
                            <br><br>
                            <div>
                                <button id="button-back" type="button">戻る</button>
                                <button id="button-submit" type="button">変更</button>
                            </div>
                        </form>
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