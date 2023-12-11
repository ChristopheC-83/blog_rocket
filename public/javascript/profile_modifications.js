// Elt de modification du mail
const btnModifyMail = document.querySelector("#btnModifyMail");
const formModifyMail = document.querySelector("#formModifyMail");

// elt de modification du mot de passe
const btnModifyPassword = document.querySelector("#btnModifyPassword");
const formModifyPassword = document.querySelector("#formModifyPassword");

// elt de suppression du compte
const btnDeleteAccount=document.querySelector('#btnDeleteAccount')
const cancelDelete=document.querySelector('#cancelDelete')
const deleteAccountBlock=document.querySelector('#deleteAccountBlock')


if (btnModifyMail) {
  btnModifyMail.addEventListener("click", function () {
    formModifyMail.classList.toggle("d-none");
    formModifyPassword.classList.add("d-none");
    deleteAccountBlock.classList.add("d-none");
  });
}
if (btnModifyPassword) {
  btnModifyPassword.addEventListener("click", function () {
    formModifyPassword.classList.toggle("d-none");
    formModifyMail.classList.add("d-none");
    deleteAccountBlock.classList.add("d-none");
  });
}
if (btnDeleteAccount) {
  btnDeleteAccount.addEventListener("click", function () {
    deleteAccountBlock.classList.toggle("d-none");
    formModifyMail.classList.add("d-none");
    formModifyPassword.classList.add("d-none");
  });
}
if (cancelDelete) {
  cancelDelete.addEventListener("click", function () {
    deleteAccountBlock.classList.add("d-none");
  });
}
