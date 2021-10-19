<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>記事投稿 - SEITI</title>

    <link rel="stylesheet" href="css/postArticle.css">

    <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
    <script src="js/data.js"></script>
    <script src="js/include/util.js"></script>
    <script src="js/postArticle.js?202110191344"></script>
</head>

<body>

    <div id="container">

        <header>

            <a href="top.php">
                <h1>SEITI</h1>
            </a>

        </header>

        <main>

            <h2>投稿画面</h2>

            <span>下書き一覧</span>
            <span>下書き保存</span>

            <!-- 投稿フォーム -->
            <form action="addArticle.php" method="POST" name="formPost" enctype="multipart/form-data">
                <table border="1">
                    <tr>
                        <td><label for="form-post-name">聖地名（必須）</label></td>
                        <td><input type="text" name="formPostName" id="form-post-name"></td>
                    </tr>
                    <tr>
                        <td><label for="form-post-work">作品名（必須）</label></td>
                        <td><input type="text" name="formPostWork" id="form-post-work" list="worklist"></td>
                    </tr>
                    <tr>
                        <td><label for="form-post-work-pseudonym">作品かな（必須）</label></td>
                        <td><input type="text" name="formPostWork" id="form-post-work-pseudonym" list="worklist"></td>
                    </tr>

                    <!-- タイトルの候補リスト -->
                    <datalist id="worklist">
                        <?php foreach ($wr as $r) { ?>

                        <option value="<?php echo ($r["title"]) ?>"></option>

                        <?php } ?>
                    </datalist>
                    <tr>
                        <td><label>住　所</label></td>
                        <td>
                            <fieldset>
                                <label>郵便番号</label><br>
                                <p id="search-sAddress-error"></p>
                                <input type="number" name="formPostPostal1" placeholder="郵便番号上３桁"> - <input
                                    type="number" name="formPostPostal2" placeholder="郵便番号下４桁"> <button
                                    id="search-sAddress" type="button">住所検索</button><br>

                                <label for="select-prefecture">都道府県（必須）</label><br>
                                <select name="selectPrefecture" id="select-prefecture"></select><br>

                                <label for="form-post-municipality">市区町村（必須）</label><br>
                                <input type="text" name="formPostMunicipality" id="form-post-municipality"
                                    size="50"><br>

                                <label for="form-post-last">番地以下（必須）</label><br>
                                <input type="text" name="formPostLast" id="form-post-last" size="50"><br>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="">聖地詳細（任意）</label></td>
                        <td><textarea name="formPostDetails" id="" cols="50" rows="10"
                                placeholder="特記事項や行った時の注意点など"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">写真選択（任意）</label>
                        </td>
                        <td>
                            <input type="file" accept="image/png, image/jpeg" id="form-post-image" name="formPostImage" id="">
                            <img id="preview" src="" alt="">
                        </td>
                    </tr>
                </table>
                <div>
                    <button id="formPostSubmit" type="button">投稿</button>
                </div>
            </form>

        </main>

        <footer>

            <div id="version"><?php echo ($ini["version"]) ?></div>

        </footer>

    </div>

</body>

</html>