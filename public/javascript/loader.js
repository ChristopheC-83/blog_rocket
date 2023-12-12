const overlay = document.querySelector(".overlay");
const loader = document.querySelector(".gearbox");
const btnForgotPassword = document.querySelector("#btnForgotPassword");
const btnRegistration = document.querySelector("#btnRegistration");
const resendMailValidation = document.querySelector("#resendMailValidation");

function activeLoader(fichier_php) {
  overlay.classList.remove("d-none");
  loader.classList.remove("d-none");
  fetch(fichier_php)
    .then((response) => {
      if (!response.ok) throw new Error("Erreur : mauvaise ressource.");
      return response.json();
    })
    .then((response) => {
      overlay.classList.add("d-none");
      loader.classList.add("d-none");
      return;
    })
    .catch((e) => {
      console.log(e);
    });
}

if (resendMailValidation) {
  resendMailValidation.addEventListener("click", () => {
    activeLoader("user.controller.php");
  });
}
if (btnForgotPassword) {
  btnForgotPassword.addEventListener("click", () => {
    activeLoader("user.controller.php");
  });
}
if (btnRegistration) {
  btnRegistration.addEventListener("click", () => {
    activeLoader("visitor.controller.php");
  });
}
