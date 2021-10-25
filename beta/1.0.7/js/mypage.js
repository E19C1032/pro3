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

});