window.onload = () => {

    let buttonCreateAccount = document.getElementById("button-create-account");
    buttonCreateAccount.onclick = () => {
        let username = document.querySelector("input[name='username']").value;
        let mailAddress = document.querySelector("input[name='mailAddress']").value;
        let password = document.querySelector("input[name='password']").value;
        let password2 = document.querySelector("input[name='password2']").value;
        let consent = document.querySelector("input[name='consent']");

        if(!isBlank(username) && !isBlank(mailAddress) && !isBlank(password) && !isBlank(password2) && consent.checked)
            if(password === password2)
                document.formCreateAccount.submit();
    }

}