window.addEventListener("load", () => {

    let inputSearch = document.getElementById("input-search");
    inputSearch.onkeydown = e => {
        if(e.key === "Enter") {
            document.location.href = `search.php?keyword=${ inputSearch.value }`;
        }
    }

});