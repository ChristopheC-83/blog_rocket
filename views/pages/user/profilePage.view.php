<div class="container">


    <div class="col-12 col-lg-10 col-xl-8 col-xxl-6 mx-auto border border-3 border-primary mt-5 rounded-3 box-shadow-white fs-5">




        <div class="my-4" method="POST" action="validation_login">

            <div class="w-100">
                <img src="<?= AVATARS_PATH . $datasUser['avatar'] ?>" alt="avatar utilisateur" class="w-50 rounded-circle border border-3 border-primary mx-auto d-block box-shadow-white">
            </div>
            <div class="w-100  my-5">
                <button class="bg-primary text-light p-3 w-75 mx-auto text-center rounded-3 d-block text-decoration-none" data-bs-toggle="modal" data-bs-target="#avatarSite">Changer l'avatar pour une image du site.</button>
                <?php require_once("views/components/modalAvatarsSite.php") ?>

<br>

                <form action="<?= URL ?>account/modify_image_by_perso" enctype="multipart/form-data" method="post" class="bg-primary text-light p-3 w-75 mx-auto text-center rounded-3 d-block text-decoration-none cupo">
                <label for="image" class="cupo">  Changer l'avatar pour une image perso </label>
                    <input type="file" id="image" name="image" onchange="submit()" value="Parcourir" class="d-none">
                </form>


            </div>
            <div class="row p-3">
                <div class="col-12 col-md-9 mx-auto my-5">
                    <p><span class="h3">Pseudo : </span> <?= $datasUser['login'] ?></p>
                    <p><span class="h3">Role : </span> <?= $datasUser['role'] ?></p>
                    <p id="btnModifyMail" class="cupo"><span class="h3">Mail : </span> <?= $datasUser['mail'] ?> <i class="fa-solid fa-pen"></i></p>
                    <!-- bloc de modification de l'email  -->
                    <div class="d-none" id="formModifyMail">
                        <?php require_once("views/components/modifyMailBlock.php")  ?>
                    </div>
                    <p id="btnModifyPassword" class="cupo"><span class="h3">Mot de passe : </span> modification <i class="fa-solid fa-pen"></i></p>
                    <!-- bloc de modification du mot de passe  -->
                    <div class="d-none" id="formModifyPassword">
                        <?php require_once("views/components/modifyPasswordBlock.php")  ?>
                    </div>
                    <div class="mt-3 w-100 mx-auto d-flex flex-column gap-3 justify-content-center align-items-center ">
                        <button id="btnDeleteAccount" class="btn btn-danger w-100 fs-5 text-light fw-bold">Suppression du compte</button>
                        <div class="w-100 d-none" id="deleteAccountBlock">
                            <p class="text-danger text-center fw-bold fs-3">Je comprends que cette suppression <br>est définitive et irréversible</p>
                            <button id="cancelDelete" class="btn btn-primary w-100 fs-5 text-light fw-bold mb-3">ANNULER</button>
                            <a href="delete_account" class="w-100"><button class="btn btn-danger w-100 fs-5 text-light fw-bold">Je valide la supression de mon compte</button></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>