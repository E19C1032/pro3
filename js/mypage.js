window.onload = () => {

    let buttonEdit = document.querySelectorAll(".article-edit");
    buttonEdit.forEach(e => {
        let aid = e.parentElement.parentElement.dataset.aid;
        e.onclick = () => {
            window.location.href = "repost_article.php?aid=" + aid;
        }
    });

}