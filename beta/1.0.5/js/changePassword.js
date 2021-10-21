window.addEventListener("load", () => {

    let formNowPassword = document.getElementById("form-now-password");
    let formNewPassword = document.getElementById("form-new-password");
    let formNewPassword2 = document.getElementById("form-new-password2");

    let buttonBack = document.getElementById("buttonBack");
    buttonBack.onclick = () => {
        document.location.href = "mypage.php";
    }

    let buttonSubmit = document.getElementById("buttonSubmit");
    buttonSubmit.onclick = () => {
        if(isPassword(formNowPassword.value) && isPassword(formNewPassword.value) && isPassword(formNewPassword2.value) && (formNewPassword.value == formNewPassword2.value)) {
            document.formPost.submit();
        } else {
            alert("入力が正しくありません。");
        }
    }

});