window.addEventListener("load", () => {

    let selectSort = document.getElementById("select-sort");
    selectSort.oninput = () => {
        let sort = selectSort.value;

        let articles = document.querySelectorAll(".report-row");
        let elems = Array.from(articles);
        // ソート
        for(let i = 0; i < elems.length - 1; i++) {
            let g = elems[i];
            if(g.dataset[sort] < elems[i + 1].dataset[sort]) {
                elems[i] = elems[i + 1];
                elems[i + 1] = g;

                elems[i].after(elems[i + 1]);
            }
        }
    }

});