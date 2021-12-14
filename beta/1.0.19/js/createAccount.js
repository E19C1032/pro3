window.onload = () => {

    let buttonCreateAccount = document.getElementById("button-create-account");
    buttonCreateAccount.onclick = () => {
        let username = document.querySelector("input[name='username']");
        let mailAddress = document.querySelector("input[name='mailAddress']");
        let password = document.querySelector("input[name='password']");
        let password2 = document.querySelector("input[name='password2']");
        let consent = document.querySelector("input[name='consent']");

        if(!isBlank(username.value) && isEmailAddress(mailAddress.value) && isPassword(password.value) && isPassword(password2.value) && consent.checked) {
            if(password.value == password2.value) {
                document.formCreateAccount.submit();
            } else {
                password.classList.add("err");
                password2.classList.add("err");
            }
        } else {
            if(isBlank(username.value)) {
                username.classList.add("err");
            } else {
                username.classList.remove("err");
            }

            if(!isEmailAddress(mailAddress.value)) {
                mailAddress.classList.add("err");
            } else {
                mailAddress.classList.remove("err");
            }

            if(!isPassword(password.value)) {
                password.classList.add("err");
            } else {
                password.classList.remove("err");
            }

            if(!isPassword(password2.value)) {
                password2.classList.add("err");
            } else {
                password2.classList.remove("err");
            }

            if(!consent.checked) {
                consent.classList.add("err");
            } else {
                consent.classList.remove("err");
            }
        }
    }

}