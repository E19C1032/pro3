<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/search.css?202110181542">
</head>

<body>
    <div id="wrapper">
        <div id="fixed-area">
            <header>
                <a href="top.php">
                    <h1>SEITI</h1>
                </a>
            </header>
        </div>

        <div id="container">
            <div id="main">
                <input type="text"><br>
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    echo $result[$i]["title"];
                }
                ?>

            </div>
            <div id="aside">
                <div id="pr">
                    <?php
                    for ($i = 0; $i < count($pr); $i++) {
                        $sql = "SELECT title, titlePseudonym FROM work WHERE workID = " . $pr[$i]["workID"] . ";";
                        $result = $conn->query($sql)->fetch();

                        echo $result["title"];
                        echo $result["titlePseudonym"];
                    }
                    ?>
                </div>
                <div id="lr">
                    <?php
                    for ($i = 0; $i < count($lr); $i++) {
                        echo $lr[$i]["name"];
                    }
                    ?>
                </div>
                <div id="fr">
                    <?php
                    for ($i = 0; $i < count($fr); $i++) {
                        $sql = "SELECT articleID, name FROM article WHERE articleID = " . $fr[$i]["articleID"] . ";";
                        $result = $conn->query($sql)->fetch();

                        echo $result["name"];
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stickyfill/2.1.0/stickyfill.min.js"></script>
</body>

</html>