window.addEventListener("load", () => {

    if(getParam("err", window.location.href) == 0) {
        alert("このファイルは対応していません。");
        location.href = "changeProfile.php";
    }

    let imgUserIcon = document.getElementById("user-icon");
    let inputUserIcon = document.getElementById("form-user-icon");
    let inputHUserIcon = document.getElementById("form-h-user-icon");

    let trim = new Trim({
        size: 160,
        type: "png",
        edge: "circle"
    });

    trim.ontrim = e => {
        imgUserIcon.width = 160;
        imgUserIcon.height = 160;

        imgUserIcon.src = e.detail.result;
        inputHUserIcon.value = e.detail.result;
        trim.close();
    }

    inputUserIcon.onchange = e => {
        let fr = new FileReader();
        let file = e.target.files[0];

        fr.onload = () => {
            let result = fr.result;

            trim.open(result);
        }
        fr.readAsDataURL(file);
    }

    let buttonBack = document.getElementById("button-back");
    buttonBack.onclick = () => {
        window.location.href = "mypage.php";
    }

    let buttonSubmit = document.getElementById("button-submit");
    buttonSubmit.onclick = () => {
        document.formUpdateProfile.submit();
    }

});