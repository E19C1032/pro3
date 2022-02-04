window.onload = () => {
    // 行きたいボタン
    let buttonGo = document.getElementById("button-go");
    buttonGo.onclick = () => {
        // ログインしているか？
        if (typeof uid === "undefined") {
            return (location.href = "login.php");
        }

        if (!buttonGo.classList.contains("disable")) {
            buttonGo.classList.add("disable");

            let pushed = buttonGo.dataset.push == "true";
            let aid = buttonGo.dataset.aid;
            if (pushed) {
                // 非同期でunpushGo.phpを実行
                let request = new XMLHttpRequest();
                request.open("GET", `./unpushGo.php?aid=${aid}`, true);
                request.responseType = "json";
                request.timeout = 10000;

                request.onload = (response) => {
                    let result = response.target.response;

                    // 処理が成功したか？
                    if (result.c) {
                        buttonGo.innerText = "行きたい " + result.go;
                        buttonGo.dataset.push = false;
                    } else {
                        alert("もう一度お試しください。");
                    }

                    buttonGo.classList.remove("disable");
                };

                request.ontimeout = (e) => {
                    alert("通信がタイムアウトしました。");
                    buttonGo.classList.remove("disable");
                };

                request.send();
            } else {
                // 非同期でpushGo.phpを実行
                let request = new XMLHttpRequest();
                request.open("GET", `./pushGo.php?aid=${aid}`, true);
                request.responseType = "json";
                request.timeout = 10000;

                request.onload = (response) => {
                    let result = response.target.response;

                    buttonGo.innerText = "行きたい " + result.go;

                    // 処理が成功したか？
                    if (result.c) {
                        buttonGo.dataset.push = true;
                    } else {
                        alert("もう一度お試しください。");
                    }

                    buttonGo.classList.remove("disable");
                };

                request.ontimeout = (e) => {
                    alert("通信がタイムアウトしました。");
                    buttonGo.classList.remove("disable");
                };

                request.send();
            }
        }
    };

    // お気に入りボタン
    let buttonFavorite = document.getElementById("button-favorite");
    buttonFavorite.onclick = () => {
        // ログインしているか？
        if (typeof uid === "undefined") {
            return (location.href = "login.php");
        }

        if (!buttonFavorite.classList.contains("disable")) {
            buttonFavorite.classList.add("disable");

            let pushed = buttonFavorite.dataset.push == "true";
            let aid = buttonFavorite.dataset.aid;
            if (pushed) {
                // 非同期でunpushFavorite.phpを実行
                let request = new XMLHttpRequest();
                request.open("GET", `./unpushFavorite.php?aid=${aid}`, true);
                request.responseType = "json";
                request.timeout = 10000;

                request.onload = (response) => {
                    let result = response.target.response;

                    // 処理が成功したか？
                    if (result.c) {
                        buttonFavorite.dataset.push = false;
                    } else {
                        alert("もう一度お試しください。");
                    }

                    buttonFavorite.classList.remove("disable");
                };

                request.ontimeout = (e) => {
                    alert("通信がタイムアウトしました。");
                    buttonFavorite.classList.remove("disable");
                };

                request.send();
            } else {
                // 非同期でpushFavorite.phpを実行
                let request = new XMLHttpRequest();
                request.open("GET", `./pushFavorite.php?aid=${aid}`, true);
                request.responseType = "json";
                request.timeout = 10000;

                request.onload = (response) => {
                    let result = response.target.response;

                    // 処理が成功したか？
                    if(result.error == 0) {
                        buttonFavorite.dataset.push = true;
                    } else if(result.error == 2) {
                        alert("お気に入りが上限に達しました（50件）。");
                    } else {
                        alert("もう一度お試しください。");
                    }

                    buttonFavorite.classList.remove("disable");
                };

                request.ontimeout = (e) => {
                    alert("通信がタイムアウトしました。");
                    buttonFavorite.classList.remove("disable");
                };

                request.send();
            }
        }
    };

    // 行き方ボタン
    let buttonRoute = document.getElementById("button-route");
    buttonRoute.onclick = () => {
        let dest = buttonRoute.dataset.dest;
        if(!buttonRoute.classList.contains("disable")) {
            window.open(`https://www.google.com/maps/dir/?api=1&destination=${ dest }`, "_blank");
        }
    }

    // 通報
    let inputReportType = document.querySelectorAll("input[name='inputReportType']");
    let inputReportDetails = document.getElementById("input-report-details");
    let inputReportAid = document.getElementById("input-report-aid");
    let reportContainer = document.getElementById("report-container");
    let buttonShowReport = document.getElementById("button-show-report");
    let buttonReport = document.getElementById("button-report");
    let popReport = document.getElementById("pop-up1");
    buttonReport.onclick = () => {
        if (!buttonReport.classList.contains("disable")) {
            buttonReport.classList.add("disable");

            if (typeof uid === "undefined") {
                return (location.href = "login.php");
            }

            let flag = false;
            let type = 0;
            let details = inputReportDetails.value;
            let aid = inputReportAid.value;

            inputReportType.forEach((t) => {
                if (t.checked) {
                    type = t.value;
                    flag = true;
                }
            });

            if (flag) {
                let request = new XMLHttpRequest();
                request.open(
                    "GET",
                    `./reportArticle.php?aid=${aid}&type=${type}&details=${details}`,
                    true
                );
                request.responseType = "json";
                request.timeout = 10000;

                request.onload = (e) => {
                    let response = e.target.response;

                    if (response.c) {
                        alert("通報が完了しました。");
                        popReport.checked = false;
                    } else {
                        alert("もう一度お試しください。");
                    }

                    reportContainer.classList.remove("active");
                    buttonReport.classList.remove("disable");
                };

                request.ontimeout = (e) => {
                    alert("通信がタイムアウトしました。");
                    buttonReport.classList.remove("disable");
                };

                request.send();
            } else {
                alert("報告内容を選択してください。");
                buttonReport.classList.remove("disable");
            }
        }
    };

    let postCommentContainer = document.getElementById("post-comment-container");

    // コメント投稿
    let buttonComment = document.getElementById("button-post-comment");
    buttonComment.onclick = () => {
        // ログインしているか？
        if (typeof uid === "undefined") {
            return (location.href = "login.php");
        }
    };

    let buttonCancelComment = document.getElementById("button-form-comment-cancel");
    buttonCancelComment.onclick = () => {
        let inputComment = document.getElementById("textarea-form-comment");
        let inputImage = document.querySelector("input[name='formCommentImage']");

        if (!isBlank(inputComment.value) || inputImage.value.length > 0)
            if (!confirm("入力内容を破棄しますか？")) return;

        postCommentContainer.classList.remove("active");
        inputComment.value = "";
        inputImage.value = "";
    };

    let buttonSubmitComment = document.getElementById(
        "button-form-comment-submit"
    );
    buttonSubmitComment.onclick = () => {
        if (!buttonCancelComment.classList.contains("disable")) {
            buttonCancelComment.classList.add("disable");

            let inputComment = document.getElementById("textarea-form-comment").value;
            let inputImage = document.querySelector(
                "input[name='formCommentImage']"
            ).value;

            if (isBlank(inputComment) && inputImage.length == 0) {
                alert("少なくともどちらか一方を入力してください。");
                buttonCancelComment.classList.remove("disable");
            } else {
                document.formComment.submit();
            }
        }
    };

    // ホスト
    // 記事削除
    let buttonRemoveArticle = document.getElementById("button-remove-article");
    if (buttonRemoveArticle != undefined) {
        buttonRemoveArticle.onclick = () => {
            if (!buttonRemoveArticle.classList.contains("disable")) {
                if (confirm("記事を削除します。よろしいですか？")) {
                    buttonRemoveArticle.classList.add("disable");

                    let aid = buttonRemoveArticle.dataset.aid;

                    let request = new XMLHttpRequest();
                    request.open("GET", `./removeArticle.php?aid=${aid}`, true);
                    request.responseType = "json";
                    request.timeout = 10000;

                    request.onload = (e) => {
                        let response = e.target.response;

                        if (response.c) {
                            location.href = "index.php";
                        } else {
                            alert(response.msg);
                        }

                        buttonRemoveArticle.classList.remove("disable");
                    };

                    request.ontimeout = (e) => {
                        alert("通信がタイムアウトしました。");
                        buttonRemoveArticle.classList.remove("disable");
                    };

                    request.send();
                }
            }
        };
    }

    let buttonRemoveComment = document.querySelectorAll(".button-remove-comment");
    buttonRemoveComment.forEach((comment) => {
        comment.onclick = () => {
            if (!comment.classList.contains("disable")) {
                if (confirm("コメントを削除します。よろしいですか？")) {
                    comment.classList.add("disable");

                    let cid = comment.dataset.cid;

                    let request = new XMLHttpRequest();
                    request.open("GET", `./removeComment.php?cid=${cid}`, true);
                    request.responseType = "json";
                    request.timeout = 10000;

                    request.onload = (e) => {
                        let response = e.target.response;

                        if (response.c) {
                            location.reload();
                        } else {
                            alert(response.msg);
                        }

                        comment.classList.remove("disable");
                    };

                    request.ontimeout = (e) => {
                        alert("通信がタイムアウトしました。");
                        comment.classList.remove("disable");
                    };

                    request.send();
                }
            }
        };
    });

    getLatLng(mapData);
};