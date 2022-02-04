window.onload = () => {
    //ポップアップ用

    const ALERT_POP_COOKIE = "alertPop"; // cookie名
    const MAX_AGE = 60 * 60 * 24 * 30; // cookieの有効期限（１か月）
    let cookies = document.cookie;
    let cookiesArr = cookies.split(";");

    let flag = false;
    for (let i = 0; i < cookiesArr.length; i++) {
        let cookie = cookiesArr[i].split("=")[0];
        if (cookie.trim(" ") == ALERT_POP_COOKIE) {
            flag = true;
            break;
        }
    }

    if (!flag) {
        document.cookie = `${ALERT_POP_COOKIE}=false;max-age=${MAX_AGE}`;

        $(".popup-index").addClass("active").hide().fadeIn(300);

        $("#close").on("click", function() {
            $(".popup-index").fadeOut(300);
        });
    }

    let inputSearch = document.getElementById("input-search");
    inputSearch.onkeydown = (e) => {
        if (e.key === "Enter") {
            document.location.href = `search.php?keyword=${inputSearch.value}`;
        }
    };

    getLatLng(mapData);
};