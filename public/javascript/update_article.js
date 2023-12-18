//  MAJ de l'id de l'article dans le formulaire de update_article
// pour travailler sur l'article choisi

const oneArticleForm = document.getElementById("oneArticleForm");
const oneArticle = document.getElementById("oneArticle");

oneArticle.addEventListener("change", function () {
  oneArticleForm.action = this.value;
  oneArticleForm.submit();
});

//  gestion visibilité formulaires d'ajout de médias

const btnImage = document.getElementById("btn-media-image");
const btnSlider = document.getElementById("btn-media-slider");
const btnVideo = document.getElementById("btn-media-video");
const btnErase = document.getElementById("btn-media-erase");

const formImage = document.getElementById("form-image");
const formSlider = document.getElementById("form-slider");
const formVideo = document.getElementById("form-video");
const formErase = document.getElementById("form-erase");

const forms = [formImage, formSlider, formVideo, formErase];
const btns = [btnImage, btnSlider, btnVideo, btnErase];

function toggleForm(formToShow, btnToShow) {
  forms.forEach((form) => {
    if (form === formToShow) {
      form.classList.remove("d-none");
      return;
    } else {
      form.classList.add("d-none");
    }
  });
  btns.forEach((btn) => {
    btn.classList.remove("fw-bold");
    btn.classList.remove("text-black");
    if (btn == btnToShow) {
      btn.classList.add("fw-bold");
      btn.classList.add("text-black");
    }
  });
}
btnImage.addEventListener("click", () => {
  toggleForm(formImage, btnImage);
  btnImage.classList.add("fw-bold");
});

btnSlider.addEventListener("click", () => {
  toggleForm(formSlider, btnSlider);
});
btnVideo.addEventListener("click", () => {
  toggleForm(formVideo, btnVideo);
});
btnErase.addEventListener("click", () => {
  toggleForm(formErase, btnErase);
});

// suppression article
// on va éviter une fausse manip en demandant une confirmation
const btnDelete = document.getElementById("btnDeleteArticle");
const formDeleteArticle = document.getElementById("formDeleteArticle");

if(btnDelete){
  btnDelete.addEventListener("click", () => {
    formDeleteArticle.classList.toggle('d-none');
    btnDelete.innerHTML =  formDeleteArticle.classList.contains('d-none')  ? ' Je veux supprimer cet article.' : ' Je ne veux supprimer pas cet article.';
  });
}