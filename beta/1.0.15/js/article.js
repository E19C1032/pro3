window.addEventListener("load", () => {

    let selectSort = document.getElementById("select-sort");
    selectSort.oninput = () => {
        let sort = selectSort.value;

        let container = document.getElementById("articles-container");
        let articles = document.querySelectorAll(".article-container");
        let elems = Array.from(articles);

        elems.forEach(elem => {
            container.removeChild(elem);
        });

        // ソート
        for(let i = 0; i < elems.length - 1; i++) {
            for(let j = 1; j < elems.length - i; j++) {
                let g = elems[i];
                if(g.dataset[sort] < elems[i + j].dataset[sort]) {
                    elems[i] = elems[i + j];
                    elems[i + j] = g;
                }
            }
        }
        
        elems.forEach(elem => {
            container.appendChild(elem);
        });
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
                    request.timeout = 10000;

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

                    request.ontimeout = e => {
                        alert("通信がタイムアウトしました。");
                        button.classList.remove("disable");
                    }

                    request.send();
                } else {
                    // 非同期でpushGo.phpを実行
                    let request = new XMLHttpRequest();
                    request.open("GET", `./pushGo.php?aid=${aid}`, true);
                    request.responseType = "json";
                    request.timeout = 10000;

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

                    request.ontimeout = e => {
                        alert("通信がタイムアウトしました。");
                        button.classList.remove("disable");
                    }

                    request.send();
                }
            }
        }
    });

    // 通報
    let inputReportType = document.querySelectorAll("input[name='inputReportType']");
    let inputReportDetails = document.getElementById("input-report-details");
    let inputReportAid = document.getElementById("input-report-aid");
    let reportContainer = document.getElementById("report-container");
    let buttonShowReport = document.querySelectorAll(".button-show-report");
    let popReport = document.getElementById("pop-up2");
    buttonShowReport.forEach(report => {
        report.onclick = () => {
            inputReportAid.value = report.dataset.aid;
        }
    });

    let buttonReport = document.getElementById("button-report");
    buttonReport.onclick = () => {
        if(!buttonReport.classList.contains("disable")) {
            buttonReport.classList.add("disable");

            let flag = false;
            let type = 0;
            let details = inputReportDetails.value;
            let aid = inputReportAid.value;

            if(aid == "") {
                return alert("もう一度お試しください。");
            }

            inputReportType.forEach(t => {
                if(t.checked) {
                    type = t.value;
                    flag = true;
                }
            });

            if(flag) { 
                let request = new XMLHttpRequest();
                request.open("GET", `./reportArticle.php?aid=${ aid }&type=${ type }&details=${ details }`, true);
                request.responseType = "json";
                request.timeout = 10000;

                request.onload = e => {
                    let response = e.target.response;

                    if(response.c) {
                        alert("通報が完了しました。");
                        popReport.checked = false;
                    } else {
                        alert(response.msg);
                    }

                    reportContainer.classList.remove("active");

                    inputReportType.forEach(t => t.checked = false);
                    inputReportDetails.value = "";

                    buttonReport.classList.remove("disable");
                }

                request.ontimeout = e => {
                    alert("通信がタイムアウトしました。");
                    buttonReport.classList.remove("disable");
                }

                request.send();
            } else {
                alert("報告内容を選択してください。");
                buttonReport.classList.remove("disable");
            }
        }
    }

});