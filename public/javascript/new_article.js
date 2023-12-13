// valider l'url de l'article à sa création
//  les 3 champs doivent être remplis pour activer le bouton de validation
//  le 4eme étant un Select, il est forcément rempli

//  Par soucis de sécurité, nous vérifions coté back que l'url est bien unique
// et que les champs sont bien remplis.

//  Donc ici, double vérif (front par js et back par php)

const btnNewArticleCard = document.querySelector("#btnNewArticleCard");
const url = document.querySelector("#url");
const badUrl = document.querySelector("#badUrl");

const title = document.querySelector("#title");
const pitch = document.querySelector("#pitch");

function validateURL(url) {
  const regex = /^[a-z0-9_]+$/;
  return regex.test(url);
}


url.addEventListener("keyup", () => {
  if (validateURL(url.value)) {
    badUrl.classList.add("invisible");
    btnNewArticleCard.classList.remove("disabled");
  } else {
    badUrl.classList.remove("invisible");
    btnNewArticleCard.classList.add("disabled");
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


