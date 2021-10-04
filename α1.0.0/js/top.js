window.onload = () => {

    let inputsearch = document.getElementById("input-search");
    inputsearch.onkeydown = e => {
        if(e.key === "Enter") {
            alert("まだ検索できないん…");
        }
    }

}