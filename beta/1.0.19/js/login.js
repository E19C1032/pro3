window.onload = () => {

    let buttonLogin = document.getElementById("button-login");
    buttonLogin.onclick = () => {
        let mailAddress = document.querySelector("input[name='mailAddress']").value;
        let password = document.querySelector("input[name='password']").value;
        if(!isBlank(mailAddress) && !isBlank(password))
            document.formLogin.submit();
        else
            alert("全ての項目を入力してください。");
    }

}