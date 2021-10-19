window.onload = () => {

    let inputsearch = document.getElementById("input-search");
    inputsearch.onkeydown = e => {
        if(e.key === "Enter") {
            document.location.href = `search.php?keyword=${ inputsearch.value }`;
        }
    }

}