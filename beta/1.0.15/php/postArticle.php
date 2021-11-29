<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>記事投稿 - SEITI</title>

    <link rel="stylesheet" href="css/master.css?202111221630">

    <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
    <script src="js/data.js"></script>
    <script src="js/include/util.js?202111221630"></script>
    <script src="js/postArticle.js?202111221708"></script>
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
                        <a href="postArticle.php">
                            <li>投稿</li>
                        </a>
                        <a href="favoriteArticle.php">
                            <li>お気に入り記事</li>
                        </a>
                        <a href="latestArticle.php">
                            <li>最新記事一覧</li>
                        </a>
                        <a href="search.php">
                            <li>詳細検索</li>
                        </a>
                        <a href="mypage.php">
                            <li>マイページ</li>
                        </a>
                        <a href="logout.php">
                            <li>ログアウト</li>
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
                    <div id="container-postArticle">

                        <h2>投稿画面</h2>

                        <label id="show-draft" class="open" for="pop-up">下書き一覧</label>
                        <span id="save-draft">下書き保存</span>
                        <input type="checkbox" id="pop-up">

                        <div class="overlay">
                            <div class="window">
                                <label class="close" for="pop-up">×</label>

                                <?php if (count($dr) > 0) { ?>

                                <ul>

                                    <?php for ($i = 0; $i < count($dr); $i++) { ?>

                                    <li class="draft-item">
                                        <?php echo $dr[$i]["name"] . " " . $dr[$i]["title"] ?>
                                        <button class="draft-edit"
                                            data-did="<?php echo $dr[$i]["draftID"] ?>">編集</button>
                                        <button class="draft-remove"
                                            data-did="<?php echo $dr[$i]["draftID"] ?>">削除</button>
                                    </li>

                                    <?php } ?>

                                </ul>

                                <?php } else { ?>

                                <p>下書きがありません。</p>

                                <?php } ?>
                            </div>
                        </div>

                        <!-- 投稿フォーム -->
                        <form action="addArticle.php" method="POST" name="formPost" enctype="multipart/form-data">
                            <table border="1">
                                <tr>
                                    <td>
                                        <label for="form-post-name">聖地名（必須）</label>
                                    </td>
                                    <td>
                                        <input type="text" name="formPostName" id="form-post-name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="form-post-work">作品名（必須）</label>
                                    </td>
                                    <td>
                                        <input type="text" name="formPostWork" id="form-post-work" list="worklist">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="form-post-work-pseudonym">作品名かな（必須）</label>
                                    </td>
                                    <td>
                                        <input type="text" name="formPostWorkPseudonym" id="form-post-work-pseudonym">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="form-post-work-type">作品ジャンル（必須）</label>
                                    </td>
                                    <td>
                                        <select name="formPostWorkType" id="form-post-work-type">
                                            <option value="1">アニメ</option>
                                            <option value="2">ドラマ</option>
                                            <option value="3">ゲーム</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- タイトルの候補リスト -->
                                <datalist id="worklist">
                                    <?php

                                    foreach ($wr as $r) {
                                        $type = array(
                                            "1" => "アニメ",
                                            "2" => "ドラマ",
                                            "3" => "ゲーム"
                                        );

                                        ?>

                                    <option
                                        value="<?php echo $r["title"] . "（" . $r["titlePseudonym"] . "）（" . $type[$r["type"]] . "）" ?>"
                                        data-title="<?php echo $r["title"] ?>"
                                        data-title-pseudonym="<?php echo $r["titlePseudonym"] ?>"
                                        data-type="<?php echo $r["type"] ?>">
                                    </option>

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

                                            <label for="form-post-last">番地以下（任意）</label><br>
                                            <input type="text" name="formPostLast" id="form-post-last" size="50"><br>
                                        </fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">聖地詳細（任意）</label></td>
                                    <td><textarea name="formPostDetails" id="form-post-details" cols="50" rows="10"
                                            placeholder="特記事項や行った時の注意点など"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">写真選択（任意）</label>
                                    </td>
                                    <td>
                                        <input type="file" accept="image/png, image/jpeg" id="form-post-image"
                                            name="formPostImage" id="">
                                        <input type="hidden" id="form-post-h-image" name="formPostHImage">

                                        <img id="preview" src="" alt="">

                                    </td>
                                </tr>
                            </table>
                            <div>
                                <button id="formPostSubmit" type="button">投稿</button>
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