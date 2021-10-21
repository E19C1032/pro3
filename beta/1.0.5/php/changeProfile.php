<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>プロフィール変更 - SEITI</title>

    <link rel="stylesheet" href="css/changeProfile.css?202110212244">

    <script src="js/changeProfile.js?202110212248"></script>
</head>

<body>

    <div id="container">

        <header>

            <a href="top.php">
                <h1>SEITI</h1>
            </a>

        </header>

        <main>
            <div>
                <img id="user-icon" src="<?php echo ($iconSrc) ?>" alt="アイコン">
                <canvas id="upload-icon" width="320" height="320"></canvas>
                <br>

            </div>
            <form action="updateProfile.php" method="POST" name="formUpdateProfile">
                <input type="file" accept="image/png, image/jpeg" id="form-user-icon" name="formUserIcon">
                <input type="hidden" id="form-h-user-icon" name="formHUserIcon">
                <br>
                <br>
                <label for="">ユーザー名</label>
                <input type="text" id="form-username" name="formUsername" value="<?php echo ($result["username"]) ?>">
                <br>
                <label for="">一言コメント</label>
                <textarea id="form-user-comment" name="formUserComment" cols="30"
                    rows="10"><?php echo ($result["uComment"]) ?></textarea>
                <br><br>
                <div>
                    <button id="button-back" type="button">戻る</button>
                    <button id="button-submit" type="button">変更</button>
                </div>
            </form>

        </main>

    </div>

</body>

</html>