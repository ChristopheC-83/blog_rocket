//  MAJ de l'id de l'article dans le formulaire de update_article

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

const formImage = document.getElementById("form-image");
const formSlider = document.getElementById("form-slider");
const formVideo = document.getElementById("form-video");

const forms = [formImage, formSlider, formVideo];
const btns = [btnImage, btnSlider, btnVideo];

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
