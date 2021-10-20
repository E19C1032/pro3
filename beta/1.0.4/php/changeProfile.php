<!DOCTYPE html>
<html lang="ja" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>プロフィール変更 - SEITI</title>

        <link rel="stylesheet" href="css/common.css?202107212014">

        <script src="js/changeProfile.js?202110111347"></script>
    </head>
    <body>
        
        <div id="container">

            <header>

                <a href="top.php"><h1>SEITI</h1></a>

            </header>

            <main>

                <img id="user-icon" src="<?php echo($iconSrc) ?>" alt="アイコン">
                <canvas id="upload-icon" width="320" height="320"></canvas>

                <form action="updateProfile.php" method="POST" name="formUpdateProfile">
                    <input type="file" accept="image/png, image/jpeg" id="form-user-icon" name="formUserIcon">
                    <input type="hidden" id="form-h-user-icon" name="formHUserIcon">

                    <label for="">ユーザー名</label>
                    <input type="text" id="form-username" name="formUsername" value="<?php echo($result["username"]) ?>">

                    <label for="">一言コメント</label>
                    <textarea id="form-user-comment" name="formUserComment" cols="30" rows="10"><?php echo($result["uComment"]) ?></textarea>

                    <button id="button-back" type="button">戻る</button>
                    <button id="button-submit" type="button">変更</button>
                </form>

            </main>

            <footer>

                <div id="version"><?php echo($ini["version"]) ?></div>

            </footer>

        </div>

    </body>
</html>
