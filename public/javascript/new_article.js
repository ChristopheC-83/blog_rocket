// valider le remplissage des champs du formulaire de création d'article
// valider l'url de l'article

const btnNewArticleCard = document.querySelector("#btnNewArticleCard");
const title = document.querySelector("#title");
const pitch = document.querySelector("#pitch");
const url = document.querySelector(".url");
const badUrl = document.querySelector(".badUrl");

function validateURL(url) {
  const regex = /^[a-z0-9_]+$/;
  return regex.test(url);
}


url.addEventListener("keyup", () => {
  if (validateURL(url.value)) {
    badUrl.classList.add("noVisibility");
  } else {
    badUrl.classList.remove("noVisibility");
  }
});

function allFieldsCompleted() {
  if (
    title.value !== "" &&
    pitch.value !== "" &&
    url.value !== "" &&
    validateURL(url.value)
  ) {
    btnNewArticleCard.classList.remove("disabled");
  } else {
    btnNewArticleCard.classList.add("disabled");
  }
}

if (title) {
  title.addEventListener("keyup", () => {
    allFieldsCompleted();
  });
  pitch.addEventListener("keyup", () => {
    allFieldsCompleted();
  });
  url.addEventListener("keyup", () => {
    allFieldsCompleted();
  });
}

// const selectArticle = document.querySelector("#selectArticle");
// if (selectArticle) {
//   selectArticle.addEventListener("change", function () {
//     document.getElementById("containerNewPostCard").submit();
//   });
// }
// const selectTemplate = document.querySelector("#selectTemplate");
// if (selectTemplate) {
//   selectTemplate.addEventListener("change", function () {
//     document.getElementById("containerNewTemplate").submit();
//   });
// }
