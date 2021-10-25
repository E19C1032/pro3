window.addEventListener("load", () => {

    let selectSort = document.getElementById("select-sort");
    selectSort.oninput = () => {
        let sort = selectSort.value;

        let articles = document.querySelectorAll(".article-container");
        let elems = Array.from(articles);
        // ソート
        for(let i = 0; i < elems.length - 1; i++) {
            let g = elems[i];
            if(g.dataset[sort] < elems[i + 1].dataset[sort]) {
                elems[i] = elems[i + 1];
                elems[i + 1] = g;

                elems[i].after(elems[i + 1]);
            }
        }
    }

    let buttonGo = document.querySelectorAll(".button-go");
    buttonGo.forEach(button => {
        button.onclick = () => {
            // ログインしているか？
            if (typeof uid === "undefined") {
                return (location.href = "login.php");
            }

            if(!button.classList.contains("disable")) {
                button.classList.add("disable");

                let pushed = button.dataset.push == "true";
                let aid = button.dataset.aid;
                if (pushed) {
                    // 非同期でunpushGo.phpを実行
                    let request = new XMLHttpRequest();
                    request.open("GET", `./unpushGo.php?aid=${aid}`, true);
                    request.responseType = "json";
                    request.onload = (response) => {
                        let result = response.target.response;

                        button.innerText = "行きたい " + result.go;

                        // 処理が成功したか？
                        if (result.c) {
                            button.dataset.push = false;
                        } else {
                            alert("もう一度お試しください。");
                        }

                        button.classList.remove("disable");
                    };
                    request.send();
                } else {
                    // 非同期でpushGo.phpを実行
                    let request = new XMLHttpRequest();
                    request.open("GET", `./pushGo.php?aid=${aid}`, true);
                    request.responseType = "json";
                    request.onload = (response) => {
                        let result = response.target.response;

                        button.innerText = "行きたい " + result.go;

                        // 処理が成功したか？
                        if (result.c) {
                            button.dataset.push = true;
                        } else {
                            alert("もう一度お試しください。");
                        }

                        button.classList.remove("disable");
                    };
                    request.send();
                }
            }
        }
    });

});