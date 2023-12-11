console.log("yawp");

const imgSlider = document.querySelectorAll(".imgSlider");
const tiretSlider = document.querySelectorAll(".tiretSlider");
let etape = 0;
let nb_img_slider = imgSlider.length;
const btnRetour = document.querySelector(".flecheSliderGauche");
const btnAvance = document.querySelector(".flecheSliderDroite");

console.log(imgSlider);

function removeActive() {
  imgSlider.forEach((element) => {
    element.classList.remove("imgSliderActive");
  });
  tiretSlider.forEach((element) => {
    element.classList.remove("tiretSliderActive");
  });
}

btnRetour.addEventListener("click", () => {
  etape--;
  if (etape < 0) {
    etape = nb_img_slider - 1;
  }
  removeActive();
  imgSlider[etape].classList.add("imgSliderActive");
  tiretSlider[etape].classList.add("tiretSliderActive");
});
btnAvance.addEventListener("click", () => {
  etape++;
  if (etape > nb_img_slider-1) {
    etape = 0;
  }
  removeActive();
  imgSlider[etape].classList.add("imgSliderActive");
  tiretSlider[etape].classList.add("tiretSliderActive");
});
