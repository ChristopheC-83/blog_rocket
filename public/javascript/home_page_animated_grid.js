
const card3D = document.querySelectorAll(".link_card");
card3D.forEach((cards) => {
  cards.addEventListener("onmouseover", () => {
    console.log("je suis over!!!");
  });

  cards.addEventListener("mousemove", (e) => {
    let elRect = cards.getBoundingClientRect();
    let x = e.clientX - elRect.left;
    let y = e.clientY - elRect.top;

    let midCardWidth = elRect.width / 2;
    let midCardHeight = elRect.height / 2;

    let angleY = -(x - midCardWidth) / 10;
    let angleX = (y - midCardHeight) / 10;

    cards.children[0].style.transition = "none";
    cards.children[0].style.transform = `rotateX(${angleX}deg) rotateY(${angleY}deg)`;
  });

  cards.addEventListener("mouseleave", () => {
    cards.children[0].style.transition = "transform 0.75s";
    cards.children[0].style.transform = `rotateX(0deg) rotateY(0deg)`;
  });
});

// ############################
// animation cartes seulement accueil

const currentUrl = window.location.href;
const delay = 50;


const isHomepage = "http://localhost:8090/rocket/projet_passerelle_2";
const isHomepage2 = isHomepage+"/";
const isAccueil = isHomepage+"/home";
const isAccueil2 = isHomepage+"/home/";

window.addEventListener("DOMContentLoaded", (event) => {
  card3D.forEach((card) => {
    if (
      currentUrl === isHomepage ||
      currentUrl === isHomepage2 ||
      currentUrl === isAccueil ||
      currentUrl === isAccueil2
    ) {
      card.classList.remove("dnone");
      card.classList.add("apparitionCard");
    } else {
      card.classList.remove("dnone");
    }
  });
});
