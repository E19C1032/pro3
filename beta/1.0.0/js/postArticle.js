window.onload = () => {

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

    // 投稿
    let buttonSubmit = document.getElementById("formPostSubmit");
    buttonSubmit.onclick = () => {
        let inputName = document.getElementById("form-post-name").value;
        let inputWork = document.getElementById("form-post-work").value;
        let inputMunicipality = document.getElementById("form-post-municipality").value;
        let inputLast = document.getElementById("form-post-last").value;

        if(isBlank(inputName) || isBlank(inputWork) || isBlank(inputMunicipality) || isBlank(inputLast)) return alert("必須項目をすべて入力してください。");

        document.formPost.submit();
    }

}