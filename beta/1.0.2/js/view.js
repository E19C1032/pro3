window.onload = () => {

    /**
     * コメント投稿フォームを上下左右中央寄せする
     */
    const centeringElement = elem => {
        let offsetX = (window.innerWidth - elem.clientWidth) / 2;
        let offsetY = (window.innerHeight - elem.clientHeight) / 2;
        elem.style.left = offsetX + "px";
        elem.style.top = offsetY + "px";
    }

    // 行きたいボタン
    let buttonGo = document.getElementById("button-go");
    buttonGo.onclick = () => {
        // ログインしているか？
        if(typeof uid === "undefined") {
            return location.href = "login.php";
        }

        let pushed = buttonGo.dataset.push == "true";
        let bg = document.getElementById("bg");
        bg.style.display = "flex";
        if(pushed) {
            // 非同期でunpushGo.phpを実行
            let request = new XMLHttpRequest();
            request.open("GET", `./unpushGo.php?aid=${ aid }`, true);
            request.responseType = "json";
            request.onload = response => {
                let result = response.target.response;
                
                bg.style.display = "none";
                buttonGo.innerText = "行きたい " + result.go;
               
                // 処理が成功したか？
                if(result.c) {
                    buttonGo.dataset.push = false;
                } else {
                    alert("もう一度お試しください。");
                }
            }
            request.send();
        } else {
            // 非同期でpushGo.phpを実行
            let request = new XMLHttpRequest();
            request.open("GET", `./pushGo.php?aid=${ aid }`, true);
            request.responseType = "json";
            request.onload = response => {
                let result = response.target.response;

                bg.style.display = "none";
                buttonGo.innerText = "行きたい " + result.go;

                // 処理が成功したか？
                if(result.c) {
                    buttonGo.dataset.push = true;
                } else {
                    alert("もう一度お試しください。");
                }
            }
            request.send();
        }
    }

    // お気に入りボタン
    let buttonFavorite = document.getElementById("button-favorite");
    buttonFavorite.onclick = () => {
        // ログインしているか？
        if(typeof uid === "undefined") {
            return location.href = "login.php";
        }

        let pushed = buttonFavorite.dataset.push == "true";
        let bg = document.getElementById("bg");
        bg.style.display = "flex";
        if(pushed) {
            // 非同期でunpushGo.phpを実行
            let request = new XMLHttpRequest();
            request.open("GET", `./unpushFavorite.php?aid=${ aid }`, true);
            request.responseType = "json";
            request.onload = response => {
                let result = response.target.response;
                
                bg.style.display = "none";
               
                // 処理が成功したか？
                if(result.c) {
                    buttonFavorite.dataset.push = false;
                } else {
                    alert("もう一度お試しください。");
                }
            }
            request.send();
        } else {
            // 非同期でpushGo.phpを実行
            let request = new XMLHttpRequest();
            request.open("GET", `./pushFavorite.php?aid=${ aid }`, true);
            request.responseType = "json";
            request.onload = response => {
                let result = response.target.response;

                bg.style.display = "none";

                // 処理が成功したか？
                if(result.c) {
                    buttonFavorite.dataset.push = true;
                } else {
                    alert("もう一度お試しください。");
                }
            }
            request.send();
        }
    }

    // 通報
    let buttonReport = document.getElementById("button-report");
    buttonReport.onclick = () => {
        alert("未実装");
    }

    let bg = document.getElementById("bg");
    let postCommentContainer = document.getElementById("post-comment-container");

    // コメント投稿
    let buttonComment = document.getElementById("button-post-comment");
    buttonComment.onclick = () => {
        // ログインしているか？
        if(typeof uid === "undefined") {
            return location.href = "login.php";
        }
        
        bg.style.display = "block";
        postCommentContainer.style.display = "block";

        centeringElement(postCommentContainer);
    }

    let buttonCancelComment = document.getElementById("button-form-comment-cancel");
    buttonCancelComment.onclick = () => {
        let inputComment = document.getElementById("textarea-form-comment");
        let inputImage = document.querySelector("input[name='formCommentImage']");

        if(!isBlank(inputComment.value) || inputImage.value.length > 0)
            if(!confirm("入力内容を破棄しますか？")) return;

        bg.style.display = "none";
        postCommentContainer.style.display = "none";
        inputComment.value = "";
        inputImage.value = "";
    }

    let buttonSubmitComment = document.getElementById("button-form-comment-submit");
    buttonSubmitComment.onclick = () => {
        let inputComment = document.getElementById("textarea-form-comment").value;
        let inputImage = document.querySelector("input[name='formCommentImage']").value;

        if(isBlank(inputComment) && inputImage.length == 0)
            return alert("少なくともどちらか一方を入力してください。");

        document.formComment.submit();
    }

    window.onresize = () => {
        centeringElement(postCommentContainer);
    }

}