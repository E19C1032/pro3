<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>記事投稿 - SEITI</title>

    <link rel="shortcut icon" href="wp_contents/image/icon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/master.css?202112141602">

    <script>
    const selectedPrefecture = "<?php echo $result["sAddress1"] ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
    <script src="js/data.js"></script>
    <script src="js/include/util.js?202112141602"></script>
    <script src="js/postArticle.js?202112141602"></script>
    <?php 
    
    if(isset($_GET["alert"])) { 
        if($_GET["alert"] == "draftSuccess") {    
        
    ?>

    <script>

    alert("下書きを保存しました。");
    let aid = "";
    if(getParam("aid", window.location.href) != null) {
        aid = "aid=" + getParam("aid", window.location.href);
    }

    location = location.origin + location.pathname + "?" + aid;

    </script>

    <?php 
    
        }
    } 
    
    ?>
</head>

<body>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="index.php">
                    <img src="wp_contents/image/logo.png" alt="">
                </a>
                <?php if ($login) { ?>
                <!-- ログイン時のメニュー -->
                <div>
                    <ul>
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
                    </ul>
                </div>
                <div>
                    <a href="logout.php">
                        ログアウト
                    </a>
                </div>

                <?php } else { ?>
                <div>
                    <ul>
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
                    </ul>
                </div>
                <div>
                    <a href="login.php">
                        ログイン
                    </a>
                </div>
                <?php } ?>
            </header>
        </div>
        <div id="container">

            <main>
                <div id="main-container">
                    <div id="container-repostArticle">

                        <div class="container-header">
                            <div>
                                <label id="show-draft" class="open" for="pop-up">下書き一覧</label>
                            </div>
                        </div>
                        <input type="checkbox" id="pop-up">

                        <div class="overlay">
                            <div class="window">
                                <div class="window-top">
                                    <h2>下書き一覧</h2>
                                    <label class="close" for="pop-up">×</label>
                                </div>
                                <?php if (count($dr) > 0) { ?>
                                <div class="window-main">
                                    <ul>

                                        <?php for ($i = 0; $i < count($dr); $i++) { ?>

                                        <li class="draft-item">
                                            <div class="draft-item-left">
                                                <p class="draft-name"><label><?php echo $dr[$i]["name"] ?></label></p>
                                                <p class="draft-title"><span><?php echo $dr[$i]["title"] ?></span></p>
                                            </div>
                                            <div class="draft-item-right">
                                                <button class="draft-edit"
                                                    data-did="<?php echo $dr[$i]["draftID"] ?>">編集</button>
                                                <button class="draft-remove"
                                                    data-did="<?php echo $dr[$i]["draftID"] ?>">削除</button>
                                            </div>
                                        </li>

                                        <?php } ?>

                                    </ul>
                                </div>
                                <?php } else { ?>

                                <p>下書きがありません。</p>

                                <?php } ?>
                            </div>
                        </div>
                        <!-- 投稿フォーム -->
                        <form action="updateArticle.php?aid=<?php echo $aid ?>" method="POST" name="formPost"
                            enctype="multipart/form-data">
                            <table border="1">
                                <tr>
                                    <td>
                                        <label for="form-post-name">聖地名*</label>
                                    </td>
                                    <td>
                                        <input type="text" name="formPostName" id="form-post-name"
                                            value="<?php echo $result["name"] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="form-post-work">作品名*</label>
                                    </td>
                                    <td>
                                        <input type="text" name="formPostWork" id="form-post-work" list="worklist"
                                            value="<?php echo $wr["title"] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="form-post-work-pseudonym">作品名かな*</label>
                                        <p class="post-alert">※全角ひらがな</p>
                                        <p class="post-alert">※、。・…</p>
                                    </td>
                                    <td>
                                        <input type="text" name="formPostWorkPseudonym" id="form-post-work-pseudonym"
                                            value="<?php echo $wr["titlePseudonym"] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="form-post-work-type">作品ジャンル*</label>
                                    </td>
                                    <td>
                                        <select name="formPostWorkType" id="form-post-work-type">
                                            <option value="1" <?php if($wr["type"] == 1) echo "selected"; ?>>アニメ
                                            </option>
                                            <option value="2" <?php if($wr["type"] == 2) echo "selected"; ?>>ドラマ
                                            </option>
                                            <option value="3" <?php if($wr["type"] == 3) echo "selected"; ?>>ゲーム
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- タイトルの候補リスト -->
                                <datalist id="worklist">
                                    <?php foreach ($awr as $r) { ?>

                                    <option
                                        value="<?php echo $r["title"] . "（" . $r["titlePseudonym"] . "）（" . $typeStr[$r["type"]] . "）" ?>"
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
                                            <input type="number" name="formPostPostal1" placeholder="郵便番号上３桁"> -
                                            <input type="number" name="formPostPostal2" placeholder="郵便番号下４桁">
                                            <button id="search-sAddress" type="button">住所検索</button><br>

                                            <label for="select-prefecture">都道府県*</label><br>
                                            <select name="selectPrefecture" id="select-prefecture"></select><br>

                                            <label for="form-post-municipality">市区町村*</label><br>
                                            <input type="text" name="formPostMunicipality" id="form-post-municipality"
                                                size="50" value="<?php echo $result["sAddress2"] ?>"><br>

                                            <label for="form-post-last">番地以下</label><br>
                                            <input type="text" name="formPostLast" id="form-post-last" size="50"
                                                value="<?php echo $result["sAddress3"] ?>"><br>
                                        </fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">聖地詳細</label>
                                    </td>
                                    <td>
                                        <textarea name="formPostDetails" id="form-post-details" cols="50" rows="10"
                                            placeholder="特記事項や行った時の注意点など"><?php echo $result["details"] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="">写真選択</label>
                                    </td>
                                    <td>
                                        <input type="file" accept="image/png, image/jpeg" name="formPostImage"
                                            id="form-post-image"><br>
                                        <input type="hidden" id="form-post-h-image" name="formPostHImage"
                                            value="<?php

                                                                if ($result["image"] != null) {
                                                                    echo base64_encode(file_get_contents("image/" . $result["image"]));
                                                                }

                                                                ?>">

                                        <img id="preview" src="<?php

                                                                if ($result["image"] != null) {
                                                                    echo readImageToBase64("image/" . $result["image"]);
                                                                } else {
                                                                    echo readImageToBase64("image/noimage.png");
                                                                }

                                                                ?>" alt="">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <div class="container-footer">
                            <div>
                                <div>
                                    <span id="save-draft">下書き保存</span>
                                </div>
                                <div>
                                    <button id="formPostSubmit" type="button">再投稿</button>
                                </div>
                                <div>
                                </div>
                            </div>
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

</body>

</html>