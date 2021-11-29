window.addEventListener("load", () => {

    let buttonSubmit = document.getElementById("button-submit");
    let emailAddress = document.getElementById("email-address");
    buttonSubmit.onclick = () => {
        if(!buttonSubmit.classList.contains("disable")) {
            buttonSubmit.classList.add("disable");

            if(isEmailAddress(emailAddress.value)) {
                document.formResettingPassword.submit();
            } else {
                alert("メールアドレスが正しくありません。");
                buttonSubmit.classList.remove("disable");
            }
        }
    }

});