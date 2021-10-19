window.addEventListener("load", () => {

    let formNowEmailAddress = document.getElementById("form-now-email-address");
    let formNewEmailAddress = document.getElementById("form-new-email-address");
    let formNewEmailAddress2 = document.getElementById("form-new-email-address2");

    let buttonBack = document.getElementById("buttonBack");
    buttonBack.onclick = () => {
        document.location.href = "mypage.php";
    }

    let buttonSubmit = document.getElementById("buttonSubmit");
    buttonSubmit.onclick = () => {
        if(isEmailAddress(formNowEmailAddress.value) && isEmailAddress(formNewEmailAddress.value) && isEmailAddress(formNewEmailAddress2.value) && (formNewEmailAddress.value == formNewEmailAddress2.value)) {
            document.formPost.submit();
        } else {
            alert("入力が正しくありません。");
        }
    }

});