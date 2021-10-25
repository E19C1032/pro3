window.addEventListener("load", () => {

    let aid = 4;
    let request = new XMLHttpRequest();
    request.open("GET", `./requestArticle.php?wid=${ aid }&sort=date&order=desc`, true);
    request.responseType = "json";
    request.onload = e => {
        console.log(e.target.response);
    }
    request.send();

});