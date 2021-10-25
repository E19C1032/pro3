<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>記事投稿 - SEITI</title>

    <link rel="stylesheet" href="css/repostArticle.css?202110211911">

    <script>
    const selectedPrefecture = "<?php echo $result["sAddress1"] ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
    <script src="js/data.js"></script>
    <script src="js/include/util.js"></script>
    <script src="js/postArticle.js?202110222304"></script>
</head>

<body>

    <div id="container">

        <header>

            <a href="top.php">
                <h1>SEITI</h1>
            </a>

            <hr>

        </header>

        <main>
            <div>
                <h2>再投稿画面</h2>

                <span id="show-draft">下書き一覧</span>
                <span id="save-draft">下書き保存</span>
            </div>

            <div id="draft-container">
                <span id="close-draft">閉じる</span>

                <?php if (count($dr) > 0) { ?>

                <ul>

                    <?php for ($i = 0; $i < count($dr); $i++) { ?>

                    <li class="draft-item">
                        <?php echo $dr[$i]["name"] ?>
                        <button class="draft-edit" data-did="<?php echo $dr[$i]["draftID"] ?>">編集</button>
                        <button class="draft-remove" data-did="<?php echo $dr[$i]["draftID"] ?>">削除</button>
                    </li>

                    <?php } ?>

                </ul>

                <?php } else { ?>

                <p>下書きがありません。</p>

                <?php } ?>
            </div>

            <!-- 投稿フォーム -->
            <form action="updateArticle.php?aid=<?php echo $aid ?>" method="POST" name="formPost"
                enctype="multipart/form-data">
                <table border="1">
                    <tr>
                        <td>
                            <label for="form-post-name">聖地名（必須）</label>
                        </td>
                        <td>
                            <input type="text" name="formPostName" id="form-post-name" value="<?php echo $result["name"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="form-post-work">作品名（必須）</label>
                        </td>
                        <td>
                            <input type="text" name="formPostWork" id="form-post-work" list="worklist" value="<?php echo $wr["title"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="form-post-work-pseudonym">作品名かな（必須）</label>
                        </td>
                        <td>
                            <input type="text" name="formPostWorkPseudonym" id="form-post-work-pseudonym" value="<?php echo $wr["titlePseudonym"] ?>">
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
                        
                        foreach ($awr as $r) {
                            $type = array(
                                "1" => "アニメ",
                                "2" => "ドラマ",
                                "3" => "ゲーム"
                            );
                        
                        ?>

                        <option value="<?php echo $r["title"] . "（" . $r["titlePseudonym"] . "）（" . $type[$r["type"]] . "）" ?>"
                            data-title="<?php echo $r["title"] ?>"
                            data-title-pseudonym="<?php echo $r["titlePseudonym"] ?>"></option>

                        <?php } ?>
                    </datalist>

                    <tr>
                        <td>
                            <label>住　所</label>
                        </td>
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
                                <input type="text" name="formPostMunicipality" id="form-post-municipality" size="50"
                                    value="<?php echo $result["sAddress2"] ?>"><br>

                                <label for="form-post-last">番地以下（必須）</label><br>
                                <input type="text" name="formPostLast" id="form-post-last" size="50"
                                    value="<?php echo $result["sAddress3"] ?>"><br>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">聖地詳細（任意）</label>
                        </td>
                        <td>
                            <textarea name="formPostDetails" id="form-post-details" cols="50" rows="10"
                                placeholder="特記事項や行った時の注意点など"><?php echo $result["details"] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">写真選択（任意）</label>
                        </td>
                        <td>
                            <input type="file" accept="image/png, image/jpeg" name="formPostImage"
                                id="form-post-image"><br>
                            <input type="hidden" id="form-post-h-image" name="formPostHImage" value="<?php

                                if ($result["image"] != null) {
                                    echo base64_encode(file_get_contents("image/" . $result["image"]));
                                }

                            ?>">

                            <img id="preview" src="<?php

                                if ($result["image"] != null) {
                                    echo readImageToBase64("image/" . $result["image"]);
                                }

                            ?>" alt="">
                        </td>
                    </tr>
                </table>
                <button id="formPostSubmit" type="button">再投稿</button>
            </form>

        </main>

        <footer>

            <div id="version"><?php echo $ini["version"] ?></div>

        </footer>

    </div>

</body>

</html>