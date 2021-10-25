window.addEventListener("load", () => {

    let inputSearch = document.getElementById("input-search");
    inputSearch.onkeydown = e => {
        if(e.key === "Enter") {
            document.location.href = `search.php?keyword=${ inputSearch.value }`;
        }
    }

    let inputGenre = document.querySelectorAll("input[name='genre']");
    inputGenre.forEach(genre => {
        genre.oninput = e => {
            let type = e.target.value;

            let title = document.querySelectorAll(".title");
            title.forEach(t => {
                let tType = t.dataset.type;

                if(type == tType) {
                    t.classList.remove("disable");
                } else {
                    t.classList.add("disable");
                }
            });
        }
    });

});