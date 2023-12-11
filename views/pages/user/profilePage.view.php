<div class="container">

    <!-- <?= Tools::showArray($datasUser) ?> -->

    <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 mx-auto border border-3 border-primary mt-5 rounded-3 box-shadow-white fs-5">




        <div class="my-4" method="POST" action="validation_login">

            <div class="w-100">
                <img src="<?= AVATARS_PATH . $datasUser['avatar'] ?>" alt="avatar utilisateur" class="w-50 rounded-circle border border-3 border-primary mx-auto d-block box-shadow-white">
            </div>
            <div class="w-100  my-5">
                <a href="" class="bg-primary text-light p-3 w-75 mx-auto text-center rounded-3 d-block text-decoration-none">Changer l'avatar pour une image du site.</a>
                <br>
                <a href="" class="bg-primary text-light p-3 w-75 mx-auto text-center rounded-3 d-block text-decoration-none">Changer l'avatar pour une image personnelle.</a>
            </div>
            <div class="w-75 mx-auto my-5">
                <p><span class="h3">Pseudo : </span> <?= $datasUser['login'] ?></p>
                <p><span class="h3">Role : </span> <?= $datasUser['role'] ?></p>
                <p id="btnModifyMail" class="cupo"><span class="h3">Mail : </span> <?= $datasUser['mail'] ?> <i class="fa-solid fa-pen"></i></p>
                <div class="d-none" id="formModifyMail">
                    <?php require_once("views/components/modifyMailBlock.php")  ?>
                </div>
                <p id="btnModifyPassword" class="cupo"><span class="h3">Mot de passe : </span> modification <i class="fa-solid fa-pen"></i></p>

                <div class="d-none" id="formModifyPassword">
                    <?php require_once("views/components/modifyPasswordBlock.php")  ?>
                </div>
            </div>


        </div>
    </div>
</div>