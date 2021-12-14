window.addEventListener("load", () => {

    let buttonRemove = document.querySelectorAll(".button-remove");
    buttonRemove.forEach(remove => {
        remove.onclick = () => {
            if(!remove.classList.contains("disable")) {
                remove.classList.add("disable");

                if(confirm("本当に削除しますか？")) {
                    let aid = remove.dataset.aid;

                    // 非同期でunpushGo.phpを実行
                    let request = new XMLHttpRequest();
                    request.open("GET", `./removeArticle.php?aid=${ aid }`, true);
                    request.responseType = "json";
                    request.timeout = 10000;

                    request.onload = (response) => {
                        let result = response.target.response;

                        // 処理が成功したか？
                        if (result.c) {
                            location.reload();
                        } else {
                            alert(c.msg);
                        }

                        remove.classList.remove("disable");
                    };

                    request.ontimeout = e => {
                        alert("通信がタイムアウトしました。");
                        remove.classList.remove("disable");
                    }

                    request.send();
                } else {
                    remove.classList.remove("disable");
                }
            }
        }
    });

    let buttonEdit = document.querySelectorAll(".button-edit");
    buttonEdit.forEach(edit => {
        edit.onclick = () => {
            let aid = edit.dataset.aid;
            location.href = `repostArticle.php?aid=${ aid }`;
        }
    });

    let ud = Boolean(getParam("ud"));
    let udp = getParam("udp");
    if(ud) {
        switch(udp) {
            case "pw":
                alert("パスワードを変更しました。");
                break;
            case "ea":
                alert("メールアドレスを変更しました。");
                break;
            case "pf":
                alert("プロフィールを変更しました。");
                break;
        }

        // URLパラメータ ud, udp を削除して更新
        let url = new URL(location.href);
        url.searchParams.delete("ud");
        url.searchParams.delete("udp");

        location.href = url.href;
    }

});