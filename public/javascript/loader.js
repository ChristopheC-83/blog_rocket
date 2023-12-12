const overlaySite = document.querySelector(".overlaySite");
const loader = document.querySelector(".gearbox");
const btnForgotPassword = document.querySelector("#btnForgotPassword");

function activeLoader(fichier_php) {
  overlaySite.classList.remove("d-none");
  loader.classList.remove("d-none");
  fetch(fichier_php)
    .then((response) => {
      if (!response.ok) throw new Error("Erreur : mauvaise ressource.");
      return response.json();
    })
    .then((response) => {
      overlaySite.classList.add("d-none");
      loader.classList.add("d-none");
      return;
    })
    .catch((e) => {
      console.log(e);
    });
}


if (btnForgotPassword) {
  btnForgotPassword.addEventListener("click", () => {
    activeLoader("user.controller.php");
  });
}

