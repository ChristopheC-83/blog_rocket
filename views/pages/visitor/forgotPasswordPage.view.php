<div class="container row mx-auto">
    <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 mx-auto border border-3 border-primary mt-5 rounded-3 box-shadow-white fs-5">


        <form class="my-4" method="POST" action="<?= URL ?>send_forgot_password">

            <div class="mb-3">
                <label for="login" class="form-label">Pseudo</label>
                <input type="text" class="form-control text-primary fs-5" id="login" name="login">
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Adresse Mail</label>
                <input type="email" class="form-control text-primary fs-5" id="mail" name="mail">
            </div>

            <div class="mt-5 w-75 mx-auto d-flex flex-column gap-3 justify-content-center align-items-center ">

                <button type="submit" class="btn btn-primary w-100 text-light fs-5">Envoi nouveau mot de passe</button>

                <a href="<?= URL ?>registration" class="text-primary w-100 fs-5 text-center text-decoration-none">
                    En fait je n'ai pas de compte. Je m'inscris ICI !
                </a>
                <a href="<?= URL ?>connection" class="text-primary w-100 fs-5 text-center text-decoration-none">
                    Je m'en souviens ! Je me connecte ICI !
                </a>
            </div>
        </form>

    </div>
</div>