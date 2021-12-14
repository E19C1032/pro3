window.addEventListener("load", () => {

    let buttonFavorite = document.querySelectorAll(".button-favorite");
    buttonFavorite.forEach(favorite => {
        favorite.onclick = () => {
            // ログインしているか？
            if (typeof uid === "undefined") {
                return (location.href = "login.php");
            }

            if(!favorite.classList.contains("disable")) {
                favorite.classList.add("disable");

                let pushed = favorite.dataset.push == "true";
                let aid = favorite.dataset.aid;
                if (pushed) {
                    // 非同期でunpushGo.phpを実行
                    let request = new XMLHttpRequest();
                    request.open("GET", `./unpushFavorite.php?aid=${ aid }`, true);
                    request.responseType = "json";
                    request.timeout = 10000;

                    request.onload = (response) => {
                        let result = response.target.response;
                        console.log(result);

                        // 処理が成功したか？
                        if (result.c) {
                            favorite.dataset.push = false;
                        } else {
                            alert("もう一度お試しください。");
                        }

                        favorite.classList.remove("disable");
                    };

                    request.ontimeout = e => {
                        alert("通信がタイムアウトしました。");
                        favorite.classList.remove("disable");
                    }

                    request.send();
                } else {
                    // 非同期でpushGo.phpを実行
                    let request = new XMLHttpRequest();
                    request.open("GET", `./pushFavorite.php?aid=${aid}`, true);
                    request.responseType = "json";
                    request.timeout = 10000;

                    request.onload = (response) => {
                        let result = response.target.response;
                        console.log(result);

                        // 処理が成功したか？
                        if (result.c) {
                            favorite.dataset.push = true;
                        } else {
                            alert("もう一度お試しください。");
                        }

                        favorite.classList.remove("disable");
                    };

                    request.ontimeout = e => {
                        alert("通信がタイムアウトしました。");
                        favorite.classList.remove("disable");
                    }

                    request.send();
                }
            }
        }
    });

});