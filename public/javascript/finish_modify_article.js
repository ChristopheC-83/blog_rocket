const changeArticle = document.querySelector('#changeArticle')

if (changeArticle) {
    changeArticle.addEventListener("change", function () {
    document.getElementById("changeArticle").submit();
  });
}