//modale changement image par image site
const btn_modif_img_site = document.querySelector("#btn_modif_img_site");
const images_site = document.querySelector(".images_site");
const overlay2 = document.querySelector(".overlay");

if (btn_modif_img_site) {
  btn_modif_img_site.addEventListener("click", () => {
    images_site.classList.remove("dnone");
    overlay2.classList.remove("dnone");
  });
}
if (images_site) {
  images_site.addEventListener("click", () => {
    images_site.classList.add("dnone");
    overlay2.classList.add("dnone");
  });
}
if (overlay2) {
  overlay2.addEventListener("click", () => {
    images_site.classList.add("dnone");
    overlay2.classList.add("dnone");
  });
}
