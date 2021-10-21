window.onload = () => {

    if(getParam("err", window.location.href) == 0) {
        alert("この画像は対応していません。");
        let aid = "";
        if(getParam("aid", window.location.href) != null) {
            aid = "aid=" + getParam("aid", window.location.href);
        }

        location = location.origin + location.pathname + "?" + aid;
    }

    let inputName = document.getElementById("form-post-name");
    let inputWork = document.getElementById("form-post-work");
    let inputWorkPseudonym = document.getElementById("form-post-work-pseudonym");
    let inputPrefecture = document.getElementById("select-prefecture");
    let inputMunicipality = document.getElementById("form-post-municipality");
    let inputLast = document.getElementById("form-post-last");
    let inputDetails = document.getElementById("form-post-details");
    let inputImage = document.getElementById("form-post-image");
    let inputHImage = document.getElementById("form-post-h-image");
    let preview = document.getElementById("preview");

    let showDraft = document.getElementById("show-draft");
    let draftContainer = document.getElementById("draft-container");
    showDraft.onclick = () => {
        draftContainer.classList.add("active");
    }

    let closeDraft = document.getElementById("close-draft");
    closeDraft.onclick = () => {
        draftContainer.classList.remove("active");
    }

    let draftItems = document.querySelectorAll(".draft-item");
    draftItems.forEach(draft => {
        draft.onclick = e => {
            let did = e.target.dataset.id;

            // 非同期で下書きを読み込み
            let request = new XMLHttpRequest();
            request.open("GET", `./requestDraft.php?did=${ did }`, true);
            request.responseType = "json";
            request.onload = response => {
                let result = response.target.response;
                
                // 処理が成功したか？
                if(result.c) {
                    inputName.value = result.result.name;
                    inputWork.value = result.result.title;
                    inputWorkPseudonym.value = result.result.titlePseudonym;
                    inputPrefecture.value = result.result.sAddress1;
                    inputMunicipality.value = result.result.sAddress2;
                    inputLast.value = result.result.sAddress3;
                    inputDetails.value = result.result.details;
                    inputHImage.value = result.imageSrc;
                    preview.src = `data:image/${ result.imageExt };base64,${ result.imageSrc }`;
                } else {
                    alert(result.msg);
                }
            }
            request.send();
        }
    });

    let saveDraft = document.getElementById("save-draft");
    saveDraft.onclick = () => {
        let name = inputName.value;
        let title = inputWork.value;
        let titlePseudonym = inputWorkPseudonym.value;
        let prefecture = inputPrefecture.value;
        let municipality = inputMunicipality.value;
        let last = inputLast.value;
        let details = inputDetails.value;
        let image = inputHImage.value;

        if(isBlank(name)) {
            alert("聖地名を入力してください。");
            return;
        }

        let request = new XMLHttpRequest();
        request.open("POST", "./addDraft.php", true);
        request.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=utf-8;");
        request.onload = response => {
            let result = JSON.parse(response.target.response);
            
            // 処理が成功したか？
            if(result.c) {
                location.reload();
            } else {
                alert(result.msg);
                console.log(result);
            }
        }
        let req = `name=${ name }&title=${ title }&titlePseudonym=${ titlePseudonym }&prefecture=${ prefecture }&municipality=${ municipality }&last=${ last }&details=${ details }&image=${ image }`;
        request.send(req);
    }

    // 都道府県を選択するselectの子要素にoptionを追加
    let selectPrefecture = document.getElementById("select-prefecture");
    PREFECTURES.forEach(p => {
        let elem = document.createElement("option");
        elem.setAttribute("value", p);
        elem.innerText = p;
        if(typeof selectedPrefecture !== "undefined") {
            if(p == selectedPrefecture) {
                elem.setAttribute("selected", "");
            }
        }

        selectPrefecture.appendChild(elem);
    });


    inputWork.onchange = e => {
        let pattern = /\（.+?\）/g;

        let title = e.target.value;
        let titlePseudonym = "";
        let match = [...title.matchAll(pattern)];
        match = match[match.length - 1];

        if(match != undefined) {
            titlePseudonym = title.substr(match.index + 1, match[0].length - 2);
            title = title.substring(0, match.index);

            inputWork.value = title;
            inputWorkPseudonym.value = titlePseudonym;
        }
    }

    // 郵便番号上３桁の桁数制御
    /**
     * @type {HTMLInputElement}
     */
    let formPostPostal1 = document.querySelector("input[name='formPostPostal1']");
    formPostPostal1.oninput = e => {
        let value = e.target.value;
        if(value.length > 3) e.target.value = value.substr(0, 3);
    }

    // 郵便番号上４桁の桁数制御
    /**
     * @type {HTMLInputElement}
     */
    let formPostPostal2 = document.querySelector("input[name='formPostPostal2']");
    formPostPostal2.oninput = e => {
        let value = e.target.value;
        if(value.length > 4) e.target.value = value.substr(0, 4);
    }

    // 住所検索
    let searchSAddress = document.getElementById("search-sAddress");
    searchSAddress.onclick = () => {
        let postal1 = document.querySelector("input[name='formPostPostal1']").value;
        let postal2 = document.querySelector("input[name='formPostPostal2']").value;

        if(postal1.length != 3 || postal2.length != 4) return alert("正しい郵便番号を入力してください。");

        let api = "https://zipcloud.ibsnet.co.jp/api/search?zipcode=";
        let postal = postal1 + postal2;
        let url = api + postal;

        let address1 = "";
        let address2 = "";
        let address3 = "";
        let error = document.getElementById("search-sAddress-error");
        fetchJsonp(url, {
            timeout: 10000, //タイムアウト時間
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if(data.status === 400) { //エラー時
                error.innerText = data.message;
            } else if(data.results === null) {
                error.innerText = "郵便番号から住所が見つかりませんでした。";
            } else {
                error.innerText = "";

                address1 = data.results[0].address1;
                address2 = data.results[0].address2;
                address3 = data.results[0].address3;

                let inputPrefecture = document.querySelector(`option[value='${ address1 }']`);
                let inputmunicipality = document.getElementById("form-post-municipality");

                inputPrefecture.setAttribute("selected", "");
                inputmunicipality.value = address2 + address3;
            }
        })
        .catch(ex => { //例外処理
            console.log(ex);
        });
    }

    // 画像
    let formPostImage = document.getElementById("form-post-image");
    let imageSrc = "";
    formPostImage.onchange = e => {
        let fileReader = new FileReader();
        let file = e.target.files[0];
        let mime = file.type;
        let size = file.size / 1024**2; // MB

        if(size > 5.0) {
            alert("画像の容量が5MBを上回っています。");
            formPostImage.value = "";
            return;
        }

        fileReader.readAsDataURL(file);
        fileReader.onload = () => {
            imageSrc = fileReader.result;
            let sp = imageSrc.split(",");
            inputHImage.value = sp[sp.length - 1];
            preview.src = imageSrc;
        }
    }

    // 投稿
    let buttonSubmit = document.getElementById("formPostSubmit");
    buttonSubmit.onclick = () => {
        if(isBlank(inputName.value) || isBlank(inputWork.value) || isBlank(inputWorkPseudonym.value) || isBlank(inputMunicipality.value) || isBlank(inputLast.value)) {
            alert("必須項目をすべて入力してください。");
        } else {
            document.formPost.submit();
        }
    }

}