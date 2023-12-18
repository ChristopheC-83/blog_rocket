<!-- bloc de modif du mdp dans la page de profil -->

<form class="my-4" method="POST" action="modify_password">
    <div class="mb-3 w-100 mx-auto">
        <label for="password" class="form-label w-100 text-center">Mon ancien mot de passe :</label>
        <input type="password" class="form-control text-primary fs-5" id="password" name="password">
    </div>
    <div class="mb-3 w-100 mx-auto">
        <label for="new_password" class="form-label w-100 text-center">Mon nouveau mot de passe :</label>
        <input type="password" class="form-control text-primary fs-5" id="new_password" name="new_password">
    </div>
    <div class="mb-3 w-100 mx-auto">
        <label for="verif_password" class="form-label w-100 text-center">Je vérifie en retapant :</label>
        <input type="password" class="form-control text-primary fs-5" id="verif_password" name="verif_password">
    </div>
    <h4 class="erreurPassword d-none text-danger">Erreurs de saisies pour votre nouveau mot de passe !</h4>
    <div class="mt-3 w-100 mx-auto d-flex flex-column gap-3 justify-content-center align-items-center ">
        <button type="submit" class="btn btn-primary w-100 fs-5 disabled" id="btnValidationPassword">Je valide ce nouveau mot de passe</button>
    </div>
</form>