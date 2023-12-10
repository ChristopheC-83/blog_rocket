<div class="container row">
    <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 mx-auto border border-3 border-primary mt-5 rounded-3 box-shadow-white fs-5">


        <form class="my-4" method="POST" action="validation_login">

            <div class="mb-3">
                <label for="login" class="form-label">Pseudo</label>
                <input type="text" class="form-control text-primary fs-5" id="login" name="login" >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de Passe</label>
                <input type="password" class="form-control text-primary fs-5" id="password" name="password">
            </div>

            <div class="mt-5 w-75 mx-auto d-flex flex-column gap-3 justify-content-center align-items-center ">

                <button type="submit" class="btn btn-primary w-100 fs-5">Je me connecte</button>
                <a href="" class="btn btn-primary w-100 text-light  fs-5">
                    Je n'ai pas de compte <br> Je m'inscris !
                </a>
                <a href="" class="btn btn-primary w-100  fs-5">
                    J'ai oublié mon mot de passe.
                </a>
            </div>
        </form>

    </div>
</div>