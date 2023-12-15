const oneArticleForm = document.getElementById('oneArticleForm');
const oneArticle = document.getElementById('oneArticle');

oneArticle.addEventListener('change', function() {
    oneArticleForm.action = this.value;
    oneArticleForm.submit();
});