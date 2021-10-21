window.addEventListener("load", () => {

    let canvas = document.getElementById("upload-icon");
    let ctx = canvas.getContext("2d");
    let cWidth = canvas.width;
    let cHeight = canvas.height;

    let imgUserIcon = document.getElementById("user-icon");
    let inputUserIcon = document.getElementById("form-user-icon");
    let inputHUserIcon = document.getElementById("form-h-user-icon");
    inputUserIcon.onchange = e => {
        let fileReader = new FileReader();
        let file = e.target.files[0];
        let mime = file.type;
        let size = file.size / 1024**2;

        if(size > 5.0) {
            alert("画像の容量が5MBを上回っています。");
            inputUserIcon.value = "";
            return;
        }

        fileReader.readAsDataURL(file);
        fileReader.onload = () => {
            let data = fileReader.result;
            let image = new Image();
            image.src = data;
            image.onload = () => {
                let width = image.width;
                let height = image.height;
                let maxSideLen = width >= height ? height : width;

                ctx.clearRect(0, 0, cWidth, cHeight);
                ctx.drawImage(image, 0, 0, maxSideLen, maxSideLen, 0, 0, cWidth, cHeight);

                imgUserIcon.src = canvas.toDataURL(mime);
                inputHUserIcon.value = canvas.toDataURL(mime);
            }
        }
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