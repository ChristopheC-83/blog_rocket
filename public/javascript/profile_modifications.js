const btnModifyMail = document.querySelector("#btnModifyMail");
const formModifyMail = document.querySelector("#formModifyMail");

const btnModifyPassword = document.querySelector("#btnModifyPassword");
const formModifyPassword = document.querySelector("#formModifyPassword");



if (btnModifyMail) {
  btnModifyMail.addEventListener("click", function () {
    formModifyMail.classList.toggle("d-none");
    formModifyPassword.classList.add("d-none");
  });
}
if (btnModifyPassword) {
  btnModifyPassword.addEventListener("click", function () {
    formModifyPassword.classList.toggle("d-none");
    formModifyMail.classList.add("d-none");
  });
}

