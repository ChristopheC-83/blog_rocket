const chooseArticleForm = document.getElementById('chooseArticleForm');
const chooseArticleSelect = document.getElementById('chooseArticle');

chooseArticleSelect.addEventListener('change', function() {
    chooseArticleForm.action = this.value;
    chooseArticleForm.submit();
});